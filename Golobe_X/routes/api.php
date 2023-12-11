<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Auth\SocialiteController;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\RoomController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    //cardOfTravel
    Route::get('/show/CardsOfTravel',[HotelController::class,'index']);
    //search for filtering
    Route::get('/hotels/search',[HotelController::class,'search']);
    //ViewDetails
    Route::post('/hotels/Details/{id}',[HotelController::class,'ViewDetails']);

    //crud for hotel
    //Add hotel
    Route::post('/Add/hotel',[HotelController::class,'store']);
    //update
    Route::post('/update/hotel/{id}' , [HotelController::class , 'update']);
    //show hotel
    Route::get('/show/hotel/{id}' ,[HotelController::class , 'show']);
    //delete hotel
    Route::post('/softDelete/hotel/{id}', [HotelController::class, 'SoftDelete']);
    //show onlyTashed
    Route::get('/onlyTashed/hotels', [HotelController::class, 'NotDeleteForEver']);
    //delete for ever
    Route::post('/deleted/hotel/{id}',[HotelController::class,'forceDeleted']);

    //crud for room
    //show all rooms
    Route::get('/All/rooms',[RoomController::class,'index']);
    //Add room
    Route::post('/Add/room',[RoomController::class,'store']);
    //update
    Route::post('/update/room/{id}',[RoomController::class,'update']);
    //show room
    Route::get('/show/room/{id}' ,[RoomController::class , 'show']);
    //delete room
    Route::post('/softDelete/room/{id}', [RoomController::class, 'SoftDelete']);
    //show onlyTashed
    Route::get('/onlyTashed/rooms', [RoomController::class, 'NotDeleteForEver']);
    //delete for ever
    Route::post('/deleted/room/{id}',[RoomController::class,'forceDeleted']);

    //crud for review
    //show all review
    Route::get('/All/reviews',[ReviewController::class,'index']);
    //Add room
    Route::post('/Add/review',[ReviewController::class,'store']);
    //update
    Route::post('/update/review/{id}',[ReviewController::class,'update']);
    //show review by id
    Route::get('/show/review/{id}' ,[ReviewController::class , 'show']);
    //delete review
    Route::post('/softDelete/review/{id}', [ReviewController::class, 'SoftDelete']);
    //show onlyTashed
    Route::get('/onlyTashed/reviews', [ReviewController::class, 'NotDeleteForEver']);
    //delete for ever
    Route::post('/deleted/review/{id}',[ReviewController::class,'forceDeleted']);
});
