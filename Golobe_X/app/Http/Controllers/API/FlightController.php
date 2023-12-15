<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Company;
use App\Http\Requests\FlightRequest;
use Illuminate\Support\Facades\Log;

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
    public function search(Request $request)
    {
        try {
            $request->validate([
                'fromTo' => 'string',
                'tripType' => 'string',
                'dapartReturn' => 'string',
                'passengerClass' => 'string',
            ]);

            $query = Flight::with('company', 'flightDetail');

            if ($request->has('fromTo')) {
                $query->where('fromTo', 'like', '%' . $request->fromTo . '%');
            }

            if ($request->has('tripType')) {
                $query->where('tripType', 'like', '%' . $request->tripType . '%');
            }

            if ($request->has('dapartReturn')) {
                $query->where('dapartReturn', 'like', '%' . $request->dapartReturn . '%');
            }

            if ($request->has('passengerClass')) {
                $query->where('passengerClass', 'like', '%' . $request->passengerClass . '%');
            }

            $flights = $query->get();

            if ($flights->isEmpty()) {
                return $this->customResponse(null, 'No results found', 404);
            }

            $results = $flights->map(function ($flight) {
                return [
                    "image" => $flight->company->image,
                    "price" => $flight->price,
                    "rate" => $flight->rate,
                    "tripTime" => $flight->flightDetail->tripTime,
                ];
            });

            return $this->customResponse($results, 'Results found', 200);
        } catch (\Exception $e) {
            // Log the entire exception
            Log::error('Error executing search: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return $this->customResponse(null, 'An error occurred while searching', 500);
        }
    }
    private function customResponse($data, $message, $statusCode)
    {
        return response()->json(['data' => $data, 'message' => $message], $statusCode);


    public function searchByRate(Request $request)
    {
       // $validated = $request->validated();
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
