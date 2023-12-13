<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlightDetails;
use App\Models\Flight;
use App\Http\Requests\FlightDetailsRequest;

class FlightDetailsController extends Controller
{

    public function index()
    {
        $flightDetails = FlightDetails::all();
        return response()->json($flightDetails);
    }

    public function store(FlightDetailsRequest $request)
    {
        $validated = $request->validated();
        $path = $this->UploadPhoto($request , 'FlightDeatails' , 'photo');
        $flightDetail = new FlightDetails();
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



}
