<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SocialiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\FlightController;
use App\Http\Controllers\API\FlightDetailsController;



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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout' , [AuthController::class , 'logout']);

    Route::resource('cards', CardController::class);

    Route::get('companies', [CompanyController::class, 'index']);
    Route::get('companies/{id}', [CompanyController::class, 'show']);
    Route::post('companies', [CompanyController::class, 'store']);
    Route::post('companies/{id}', [CompanyController::class, 'update']);
    Route::delete('companies/{id}', [CompanyController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('flights', [FlightController::class, 'index']);
    Route::get('flights/{id}', [FlightController::class, 'show']);
    Route::post('flights', [FlightController::class, 'store']);
    Route::post('flights/{id}', [FlightController::class, 'update']);
    Route::delete('flights/{id}', [FlightController::class, 'destroy']);

    Route::post('flights', [FlightController::class, 'search']);
    Route::post('flightsRate', [FlightController::class, 'searchByRate']);


Route::get('flight_details', [FlightDetailsController::class, 'index']);
Route::post('flight_details', [FlightDetailsController::class, 'store']);
Route::get('flight_details/{id}', [FlightDetailsController::class, 'show']);
Route::put('flight_details/{id}', [FlightDetailsController::class, 'update']);
Route::delete('flight_details/{id}', [FlightDetailsController::class, 'destroy']);

Route::get('flightDetails/{id}', [FlightDetailsController::class, 'getFlightDetails']);
Route::post('flightReturn', [FlightDetailsController::class, 'return']);

});
