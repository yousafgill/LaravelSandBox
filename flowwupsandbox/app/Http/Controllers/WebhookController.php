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
        // $payload = json_decode($request->getContent(), true);
        // $data = $payload['data']['object'];
       $data = $request->data['object'];
        // $data = $payload->data['object'];
        
    //    dd($r['id']);
        // dd($r['client_reference_id']);
        // dd($data);
       $team = Team::findOrFail($data['client_reference_id']);
       
    //    dd($plan);
       DB::transaction(function () use ($data, $team) {
        $team->update(['stripe_id' => $data['customer']]);
        $tid=$team->id;
        $usrid=$team->user_id;
        $team_owner=User::find($usrid);
            // $team->subscriptions()->create([
            // 'name' => 'default',
            // 'stripe_id' => $data['subscription'],
            // 'stripe_status' => 'active'
            // ]);


            $plan_amount=$data['amount_subtotal'];
            $plan_amount_fee=$plan_amount/100;
            $plan=plan::where('plan_fee','=',$plan_amount_fee)->first();
            $plan_end=Carbon::now()->addMonths(1);
            
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
