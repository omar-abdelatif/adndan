<?php

use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\TombController;
use App\Http\Controllers\SMSController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('get-tombs-data', TombController::class);
// Route::post('send-email', [EmailVerificationController::class, 'send']);
