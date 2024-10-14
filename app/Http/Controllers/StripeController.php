<?php

namespace App\Http\Controllers;

use Stripe\Token;
use Stripe\Charge;
use Stripe\Stripe;
use PDF; // Add PDF facade
use App\Models\UserAttempts;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccessMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class StripeController extends Controller
{
    public function processPayment(Request $request)
    {
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

            if ($charge->status === 'succeeded') {
                // Update the 'is_paid' status in the database
                $user_attempt = UserAttempts::where('email', $request->email)->first();
                if ($user_attempt) {
                    $user_attempt->is_paid = true;
                    $user_attempt->save();

                    // Generate the PDF and store it
                    $data = [
                        'name' => $user_attempt->name,
                        'percentage' => $user_attempt->percentage,
                        'date' => date('m/d/Y'),
                    ];


                    $pdf = PDF::loadView('pdf.report', $data);

                    // Save the PDF using Laravel's Storage facade
                    $pdfContent = $pdf->output(); // Get the PDF content as string
                    $pdfFileName = 'reports/' . $user_attempt->email . '_report.pdf';
                    Storage::disk('public')->put($pdfFileName, $pdfContent);

                    // Generate the PDF URL
                    $pdfUrl = Storage::url($pdfFileName);

                    // Send the email with the PDF link
                    $user = (object)['name' => $user_attempt->name, 'email' => $user_attempt->email];
                    Mail::to($user->email)->send(new PaymentSuccessMail($user, $user_attempt->percentage, $pdfUrl));
                }

                return response()->json(['message' => 'Payment successful', 'charge' => $charge], 200);
            }
            return response()->json(['error' => 'Payment failed'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
