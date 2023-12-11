<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             =>$this->id,
            'user_id'        =>$this->user_id,
            'cardNumber'     =>$this->cardNumber,
            'expDate'        =>$this->expDate,
            'cvc'            =>$this->cvc,
            'nameOnCard'     =>$this->nameOnCard,
            'country'        =>$this->country,
            'securitySave'   =>$this->securitySave,
        ];
    }
}
