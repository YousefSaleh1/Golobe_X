<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlightDetails;
use App\Models\Flight;
use App\Http\Requests\FlightDetailsRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadPhotoTrait;

class FlightDetailsController extends Controller
{
    use UploadPhotoTrait;
use ApiResponseTrait;
    public function index()
    {
        $flightDetails = FlightDetails::all();
        return response()->json($flightDetails);
    }

    public function store(FlightDetailsRequest $request)
    {
        $flightDetail = $request->validated();
        $destination = 'flights';
        $imagePath = $this->UploadPhoto($request, $destination,'photo');
        $flightDetail = FlightDetails::create([
            'flight_id'  => $request->flight_id,
            'name' => $flightDetail['name'],
            'photo'=> $imagePath,
            'classSeate' =>$request->classSeate,
            'airplanPolicies' => $request->airplanPolicies,
            'destination' => $flightDetail['destination'],
            'tripNumber'=>$flightDetail['tripNumber'],
            'tripTime'=>$flightDetail['tripTime']
        ]);
        $flightDetail->save();
        return $this->customeRespone($flightDetail ,'ok',200);
    }

    public function show($id)
    {
        $flightDetail = FlightDetails::find($id);

        if (!$flightDetail) {
            return response()->json(['error' => 'Flight Detail not found'], 404);
        }

        return response()->json($flightDetail);
    }

    public function update(FlightDetailsRequest $request, $id)
    {
        $flightDetail = FlightDetails::find($id);

        if (!$flightDetail) {
            return response()->json(['error' => 'Flight Detail not found'], 404);
        }

        if (!empty($request->photo)) {
            $path = $this->UploadPhoto($request,'companies','photo');
        } else {
            $path = $flightDetail->photo;
        }

        $validated = $request->validated();
        $flightDetail->flight_id = $request->input('flight_id');
        $flightDetail->name = $request->input('name');
        $flightDetail->photo = $path;
        $flightDetail->classSeat = $request->input('classSeat');
        $flightDetail->airplanePolicies = $request->input('airplanePolicies');
        $flightDetail->destination = $request->input('destination');
        $flightDetail->tripNumber = $request->input('tripNumber');
        $flightDetail->tripTime = $request->input('tripTime');
        $flightDetail->save();

        return response()->json($flightDetail);
    }

    public function destroy($id)
    {
        $flightDetail = FlightDetails::find($id);

        if (!$flightDetail) {
            return response()->json(['error' => 'Flight Detail not found'], 404);
        }

        $flightDetail->delete();

        return response()->json(['message' => 'Flight Detail deleted successfully']);
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


public function return(FlightDetailsRequest $request)
    {
        $validated = $request->validated();
        $results = Flight::join('companies', 'flights.company_id', '=', 'companies.id')
            ->select('companies.image', 'flights.dapartReturn')
            ->get();

        return response()->json($results);
    }

}
