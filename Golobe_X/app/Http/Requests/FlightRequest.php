<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
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
            'fromTo'     =>['required','string'],
            'tripType'        =>['required','string'],
            'dapartReturn'            =>['required','string'],
            'passengerClass'     =>['required','string','max:255'],
            'price'        =>['required','integer'],
            'rate'   =>['required'],
        ];
    }
}
