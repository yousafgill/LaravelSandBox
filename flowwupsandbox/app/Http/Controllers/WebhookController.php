<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\plan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    public function handleCheckoutSessionCompleted(Request $request)
    {

       $data = $request->data['object'];
       $team = Team::findOrFail($data['client_reference_id']);
       

       DB::transaction(function () use ($data, $team) {
        $team->update(['stripe_id' => $data['customer']]);
        $tid=$team->id;
        $usrid=$team->user_id;
        $team_owner=User::find($usrid);
          
            $existing=\DB::table('subscriptions')
                        ->where('team_id',$tid)
                        ->join('plans','plans.name','=','subscriptions.name')
                        ->first();

            $currentplan=$existing->plan_fee*1;
            
            $existing_plan_end=$existing->ends_at;

            $plan_amount=$data['amount_subtotal'];
            $plan_amount_fee=$plan_amount/100;
            $plan=plan::where('plan_fee','=',$plan_amount_fee)->first();
            $plan_end;
            if($plan_amount_fee >= $currentplan)
            {
                $dt=carbon::create($existing_plan_end);
                $plan_end=$dt->addMonths(1);
            }else{
                $plan_end=Carbon::now()->addMonths(1);
            }
            
            // dd($plan_end);
            
            $team->subscriptions()->updateOrInsert(
                ['team_id' =>$tid ],
                ['name' => $plan->name,
                'stripe_id' => $plan->plan_stripe_code,
                'stripe_status' => 'Active',
                'stripe_plan' => $plan->plan_stripe_code,
                'quantity' => 1,
                'trial_ends_at' =>$plan_end,
                'ends_at' =>$plan_end
                ]);
        
            $team_owner->update([
                'plan_mode' =>'Subscription',
                'trial_until' =>null,
                'plan_until' =>$plan_end
            ]);
            
        });


        
        return $this->successMethod();
    }
}
