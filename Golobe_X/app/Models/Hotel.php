<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'rate',
        'priceForNight',
        'city',
        'address',
        'image',
        'freebies',
        'amenities',
        'overview'
    ];

    public function hotelBook(){
        return $this->hasMany(HotelBook::class);
    }

    public function review(){
        return $this->hasOne(Review::class);
    }

    public function favorite(){
        return $this->hasMany(Favorite::class);
    }

    public function room(){
        return $this->hasMany(Room::class);
    }
}
