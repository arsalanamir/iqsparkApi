<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\UserAttempts;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccessMail;
use Illuminate\Support\Facades\Mail;
use Stripe\Token;

class StripeController extends Controller
{
    public function processPayment(Request $request)
    {
        // dd($request->all());
        // Set Stripe API Key
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a charge with the received token
            $charge = Charge::create([
                'amount' => $request->amount * 100, // Convert amount to cents
                'currency' => 'usd',
                'description' => 'charge on website',
                'source' => $request->token, // Token from Stripe
            ]);

            if (
                $charge->status === 'succeeded'
            ) {
                // Update the 'is_paid' status in the database
                $user_attempt = UserAttempts::where('email', $request->email)->first();
                if ($user_attempt) {
                    $user_attempt->is_paid = true;
                    $user_attempt->save();
                    $user = (object)['name' => $user_attempt->name, 'email' => $user_attempt->email];
                    Mail::to($user->email)->send(new PaymentSuccessMail($user, $user_attempt->percentage));
                }


                return response()->json(['message' => 'Payment successful', 'charge' => $charge], 200);
            }
            return response()->json(['error' => 'Payment failed'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createToken(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a token for the provided card details
            $token = Token::create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);

            return response()->json(['token' => $token->id], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
