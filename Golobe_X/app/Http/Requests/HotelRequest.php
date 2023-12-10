<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class HotelRequest extends FormRequest
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
            'name' => 'required|string',
            'rate'=>'required|in:1,2,3,4,5',
            'priceForNight'=>'required|numeric',
            'city'=>'required|string',
            'address'=>'required|string',
            'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'freebies' =>'required|array',
            'amenities' =>'required|array',
            'overview'=>'required|string|max:10000'
        ];
    }
}
