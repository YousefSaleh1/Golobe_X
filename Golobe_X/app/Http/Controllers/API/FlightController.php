<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Company;
use App\Http\Requests\FlightRequest;

class FlightController extends Controller
{
    //

    public function index()
    {
        $flights = Flight::with('company')->get();
        return response()->json(['flights' => $flights]);
    }

    public function store(FlightRequest $request)
    {
        $validated = $request->validated();

        $flight = new Flight();
        $flight->fromTo = $request->input('fromTo');
        $flight->tripType = $request->input('tripType');
        $flight->dapartReturn = $request->input('dapartReturn');
        $flight->passengerClass = $request->input('passengerClass');
        $flight->price = $request->input('price');
        $flight->rate = $request->input('rate');
        $flight->company_id = $request->input('company_id');

        if ($flight->save()) {
            return response()->json(['message' => 'تم حفظ الرحلة بنجاح'], 201);
        }

        return response()->json(['message' => 'فشل في حفظ الرحلة'], 500);
    }

    public function show($id)
    {
        $flight = Flight::with('company')->find($id);
        if ($flight) {
            return response()->json(['flight' => $flight]);
        }

        return response()->json(['message' => 'لم يتم العثور على الرحلة'], 404);
    }


    public function update(FlightRequest $request, $id)
    {
        $flight = Flight::find($id);
        $validated = $request->validated();
        if ($flight) {
            $flight->fromTo = $request->input('fromTo');
            $flight->tripType = $request->input('tripType');
            $flight->dapartReturn = $request->input('dapartReturn');
            $flight->passengerClass = $request->input('passengerClass');
            $flight->price = $request->input('price');
            $flight->rate = $request->input('rate');
            $flight->company_id = $request->input('company_id');

            if ($flight->save()) {
                return response()->json(['message' => 'تم تحديث الرحلة بنجاح']);
            }

            return response()->json(['message' => 'فشل في تحديث الرحلة'], 500);
        }

        return response()->json(['message' => 'لم يتم العثور على الرحلة'], 404);
    }


    public function destroy($id)
    {
        $flight = Flight::find($id);
        if ($flight) {
            if ($flight->delete()) {
                return response()->json(['message' => 'تم حذف الرحلة بنجاح']);
            }

            return response()->json(['message' => 'فشل في حذف الرحلة'], 500);
        }

        return response()->json(['message' => 'لم يتم العثور على الرحلة'], 404);
    }



    public function search(FlightRequest $request)
    {
        $validated = $request->validated();
        $fromTo = $request->input('fromTo');
        $tripType = $request->input('tripType');
        $dapartReturn = $request->input('dapartReturn');
        $passengerClass = $request->input('passengerClass');


        $results  = Flight::where('fromTo', $fromTo)
            ->where('tripType', $tripType)
            ->where('dapartReturn', $dapartReturn)
            ->where('passengerClass', $passengerClass)
            ->orderBy('price', 'asc')
            ->join('companies', 'flights.company_id', '=', 'companies.id')
            ->select('companies.image', 'flights.price', 'flights.rate')
            ->get();


        return response()->json($results);
    }

    public function searchByRate(FlightRequest $request)
    {
        $validated = $request->validated();
        $fromTo = $request->input('fromTo');
        $tripType = $request->input('tripType');
        $dapartReturn = $request->input('dapartReturn');
        $passengerClass = $request->input('passengerClass');


        $results = Flight::where('fromTo', $fromTo)
            ->where('tripType', $tripType)
            ->where('dapartReturn', $dapartReturn)
            ->where('passengerClass', $passengerClass)
            ->orderBy('rate', 'desc')
            ->join('companies', 'flights.company_id', '=', 'companies.id')
            ->select('companies.image', 'flights.price', 'flights.rate')
            ->get();


        return response()->json($results);
    }

}
