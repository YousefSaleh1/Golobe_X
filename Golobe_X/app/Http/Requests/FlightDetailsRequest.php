<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightDetailsRequest extends FormRequest
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
            'name'             =>['required','string'],
            'photo'            =>['required','mimes:png,jpg,jpeg'],
            'classSeate'       =>['required','in:economy,firstClass,businessClass'],
            'airplanPolicies'=>'required|string',
            'destination'      =>['required','string','max:100'],
            'tripNumber'       =>['required','integer'],
            'tripTime'         =>['required','date_format:H:i:s']
        ];
    }
}
