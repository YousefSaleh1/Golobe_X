<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;


class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'        => $this->name,
            'rate'        => $this->rate,
            'priceForNight' => $this->priceForNight,
            'city'        => $this->city,
            'address'        => $this->address,
            'image'=> URL::asset('hotels/'.$this->image),
            'freebies'=>$this->freebies,
            'amenities'=>$this->amenities,
            'overview'=>$this->overview
        ];
    }
}
