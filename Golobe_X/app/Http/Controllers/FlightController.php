<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Company;

class FlightController extends Controller
{
    //

    public function createCompany(Request $request){
        $company = new Company();
        $company->name = $request->input('name');
        $company->image = $request->input('image');
        $company->policies = $request->input('policies');

        if ($company->save()) {
            return response()->json(['message' => 'تم حفظ الشركة بنجاح'], 201);
        }
        
        return response()->json(['message' => 'فشل في حفظ الشركة'], 500);
    }

    public function create(Request $request)
    {
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


    public function search(Request $request)
    {
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

}