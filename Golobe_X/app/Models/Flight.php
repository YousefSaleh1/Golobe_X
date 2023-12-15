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
        'dapartReturn',
        'passengerClass',
        'price',
        'rate',
        'company_id'
    ];

    public function favorites(){
        return $this->hasMany(Favorite::class , 'flight_id' , 'id');
    }

    public function flightTickets(){
        return $this->hasMany(FlightTicket::class , 'flight_id' , 'id' );
    }

    public function flightDetail(){
        return $this->hasOne(FlightDetails::class, 'flight_id' , 'id');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
