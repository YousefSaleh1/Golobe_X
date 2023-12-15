<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'flight_id',
        'name',
        'photo',
        'classSeate',
        'airplanPolicies',
        'destination',
        'tripNumber',
        'tripTime'
    ];

    public function flight(){
        return $this->belongsTo(Flight::class);
    }
}
