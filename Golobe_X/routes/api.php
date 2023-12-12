<?php



use App\Http\Controllers\API\Auth\PasswordRestController;
use App\Http\Controllers\API\Auth\VerifyEmailController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\SocialiteController;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\RoomController;
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

Route::post('password/email' , [PasswordRestController::class , 'sendRestEmail']);
Route::post('password/reset' , [PasswordRestController::class , 'reset'])->middleware('signed')->name('password.reset');

Route::post('email/verify/send' , [VerifyEmailController::class , 'sendMail']);
Route::post('email/verify' , [VerifyEmailController::class , 'verify'])->middleware('signed')->name('verify-email');
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
