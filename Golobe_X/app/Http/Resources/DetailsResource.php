<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;


class DetailsResource extends JsonResource
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
            'address'        => $this->address,
            'rate'        => $this->rate,
            'priceForNight' => $this->priceForNight,
            'image'=> URL::asset('hotels/'.$this->image),
            
        ];
    }
}
