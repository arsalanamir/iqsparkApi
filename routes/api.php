<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\QuestionController;
use App\Services\PaypalService;

Route::get('questions', [QuestionController::class, 'index']);
Route::post('questions', [QuestionController::class, 'store']);
Route::get('questions/{id}', [QuestionController::class, 'show']);
Route::post('questions/update', [QuestionController::class, 'update']);
Route::delete('questions/{id}', [QuestionController::class, 'destroy']);
Route::post('/contact', [QuestionController::class, 'contectUs']);

Route::post('questions/{id}/attempt', [ResultController::class, 'attempt']);
Route::post('questions/calculate-percentage', [ResultController::class, 'calculatePercentage']);
Route::post('questions/save-user-data', [ResultController::class, 'saveUserData']);

// Stripe
Route::post('stripe/create-token', [StripeController::class, 'createToken']);
Route::post('process-payment', [StripeController::class, 'processPayment']);

// PayPal
Route::post('/create-payment', function (Request $request, PaypalService $paypal) {
    $order = $paypal->createOrder('8');

    if (is_array($order) && isset($order['error'])) {
        return response()->json(['error' => $order['error']], 500);
    }

    return response()->json(['orderID' => $order->result]);
});

Route::post('/capture-payment', function (Request $request, PaypalService $paypal) {
    $result = $paypal->captureOrder($request->orderID);

    if (is_array($result) && isset($result['error'])) {
        return response()->json(['error' => $result['error']], 500);
    }

    return response()->json($result->result);
});