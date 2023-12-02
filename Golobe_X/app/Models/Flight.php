<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = [
        'fromTo',
        'tripType',
        'departReturn',
        'passengerClass',
        'price',
        'rate',
    ];

    public function favorite(){
        return $this->hasMany(Favorite::class);
    }

    public function flightTicket(){
        return $this->hasMany(FlightTicket::class);
    }

    public function flightDetailst(){
        return $this->hasOne(FlightDetails::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }
}
