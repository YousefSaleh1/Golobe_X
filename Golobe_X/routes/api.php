<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\PasswordRestController;
use App\Http\Controllers\API\Auth\SocialiteController;
use App\Http\Controllers\API\Auth\VerifyEmailController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('login/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

Route::post('password/email' , [PasswordRestController::class , 'sendRestEmail']);
Route::post('password/reset' , [PasswordRestController::class , 'reset'])->middleware('signed')->name('password.reset');

Route::post('email/verify/send' , [VerifyEmailController::class , 'sendMail']);
Route::post('email/verify' , [VerifyEmailController::class , 'verify'])->middleware('signed')->name('verify-email');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

});
