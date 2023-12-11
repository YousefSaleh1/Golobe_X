<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadPhotoTrait;
use Illuminate\Http\Request;
use App\Models\FlightDetails;
use App\Models\Flight;

class FlightDetailsController extends Controller
{
    use UploadPhotoTrait;

    public function createDetails(Request $request){

        $path = $this->UploadPhoto($request , 'FlightDeatails' , 'photo');

        $details = new FlightDetails();
        $details->flight_id = $request->input('flight_id');
        $details->name = $request->input('name');
        $details->photo = $path;
        $details->classSeate = $request->input('classSeate');
        $details->airplanPolicies = $request->input('airplanPolicies');
        $details->destination = $request->input('destination');
        $details->tripNumber = $request->input('tripNumber');
        $details->tripTime = $request->input('tripTime');

        if ($details->save()) {
            return response()->json(['message' => 'تم حفظ التفاصيل بنجاح'], 201);
        }

        return response()->json(['message' => 'فشل في حفظ التفاصيل'], 500);
    }




    public function getFlightDetails($id)
{
    $flightDetail = FlightDetails::select('flight_details.destination','flight_details.name', 'flight_details.photo','flight_details.airplanPolicies', 'flights.price', 'flights.rate')
        ->join('flights', 'flight_details.flight_id', '=', 'flights.id')
        ->where('flight_details.id', $id)
        ->first();

    if (!$flightDetail) {
        return response()->json(['message' => 'Flight detail not found'], 404);
    }

    return response()->json($flightDetail);
}


}
