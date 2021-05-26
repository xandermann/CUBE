<?php

namespace App\Http\Requests\RestaurantRequests;

use App\Http\Requests\FormRequest;

class RestaurantPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'lat_address' => 'required|numeric',
            'lng_address' => 'required|numeric',
            'number_phone' => 'required|string',
            'country' => 'required|string',
            'name' => 'required|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'full_address.required'  => 'The adress of the restaurant is required',
            'full_address.string' => 'The adress of the restaurant must be a string',
            'city.required' => 'The name of the city is required',
            'city.string' => 'The name of the city must be a string',
            'postal_code.required' => 'The postal code is required',
            'postal_code.string' => 'The postal code must be a string',
            'lat_address.required' => 'The latitude of the location is required',
            'lat_address.numeric' => 'The latitude of the location must be numeric',
            'lng_address.required' => 'The longitude of the location is required',
            'lng_address.numeric' => 'The longitude of the location must be numeric',
            'number_phone.required' => 'The number phone is required',
            'number_phone.string' => 'The number phone must be a string',
            'country.required' => 'The name of the country is required',
            'country.string' => 'The name of the country must be a string',
            'name.required' => 'The name of the restaurant is required',
            'name.string' => 'The name of the restaurant must be a string'
        ];
    }
}
