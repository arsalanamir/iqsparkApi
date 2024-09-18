<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\QuestionController;

Route::get('questions', [QuestionController::class, 'index']);
Route::post('questions', [QuestionController::class, 'store']);
Route::get('questions/{id}', [QuestionController::class, 'show']);
Route::post('questions/update', [QuestionController::class, 'update']);
Route::delete('questions/{id}', [QuestionController::class, 'destroy']);

Route::post('questions/{id}/attempt', [ResultController::class, 'attempt']);
Route::post('questions/calculate-percentage', [ResultController::class, 'calculatePercentage']);
Route::post('questions/save-user-data', [ResultController::class, 'saveUserData']);

Route::post('stripe/create-token', [StripeController::class, 'createToken']);
Route::post('process-payment', [StripeController::class, 'processPayment']);
