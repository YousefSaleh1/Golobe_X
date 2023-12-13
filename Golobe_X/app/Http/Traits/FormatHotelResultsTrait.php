<?php

namespace App\Http\Traits;

use App\Models\Review;
use Illuminate\Http\Request;


trait FormatHotelResultsTrait
{
    public function formatHotelResults($hotels)
    {
        return $hotels->map(function ($hotel) {
            $review = Review::where('hotel_id', $hotel->id)->avg('rate');
            return [
                "name" => $hotel->name,
                "address" => $hotel->address,
                "rate" => $hotel->rate,
                "amenities" => $hotel->amenities,
                "priceForNight" => $hotel->priceForNight,
                "averageRating" => $review ? round($review, 2) : 0,
            ];
        })->toArray();
    }

}
