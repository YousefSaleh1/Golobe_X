<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;
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

    protected $casts = [
        'freebies' => 'array',
        'amenities' => 'array',
    ];

    public function hotelBooks(){
        return $this->hasMany(HotelBook::class , 'hotel_id' , 'id');
    }

    public function reviews(){
        return $this->hasMany(Review::class , 'hotel_id' , 'id');
    }

    public function favorites(){
        return $this->hasMany(Favorite::class , 'hotel_id' , 'id');
    }

    public function rooms(){
        return $this->hasMany(Room::class , 'hotel_id' , 'id');
    }
}
