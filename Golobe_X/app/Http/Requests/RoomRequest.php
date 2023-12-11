<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'guestNumber' => 'required|integer',
            'available'=>'required|boolean',
            'fromDay'=>'required|date',
            'toDay'=>'required|date|after:fromDay',
            'price'=>'required|numeric',
            'hotel_id'=> 'required|exists:hotels,id',

        ];
    }

}
