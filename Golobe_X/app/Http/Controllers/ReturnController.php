<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Company;

class ReturnController extends Controller
{

    
    public function return(Request $request)
    {
        $results = Flight::join('companies', 'flights.company_id', '=', 'companies.id')
            ->select('companies.image', 'flights.dapartReturn')
            ->get();

        return response()->json($results);
    }
}
