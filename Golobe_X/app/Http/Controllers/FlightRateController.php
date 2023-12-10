<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Company;


class FlightRateController extends Controller
{
    //
    public function search(Request $request)
    {
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
