<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'photo',
        'classSeate',
        'airplanPolicies',
        'destination',
        'tripNumber',
        'tripTime',
        'flight_id'
    ];

    public function flight(){
        return $this->belongsTo(Flight::class);
    }
}
