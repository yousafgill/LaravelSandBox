<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
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

        DB::transaction(function () use ($data, $team) {
            $team->update(['stripe_id' => $data['customer']]);

            $team->subscriptions()->create([
                'name' => 'default',
                'stripe_id' => $data['subscription'],
                'stripe_status' => 'active'
            ]);
        });

        return $this->successMethod();
    }
}
