<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkout(Request $request) {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = $request->user();
        $plan = $request->input('plan');

        try {
            $session = \Stripe\Checkout\Session::create([
                'customer_email' => $user->email,
                'payment_method_types' => ['card'],
                'mode' => 'subscription',
                'client_reference_id' => $user->currentTeam->id,
                'line_items' => [[
                    'price' => $plan,
                    'quantity' => 1,
                ]],
                'success_url' => route('dashboard'),
                // 'success_url' => route('stripe.success'),
                'cancel_url' => route('billing'),
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'error' => [
                    'message' => $e->getMessage(),
                ]
            ], 400);
        }

        return response()->json(['sessionId' => $session['id']]);
    }
    public function success(Request $r){
        // dd($r);
    }

    public function portal(Request $request)
    {
        return $request->user()->currentTeam->redirectToBillingPortal(
            route('dashboard')
        );
    }
}
