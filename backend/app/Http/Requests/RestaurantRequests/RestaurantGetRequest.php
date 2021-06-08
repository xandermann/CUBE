<?php

namespace App\Http\Requests\RestaurantRequests;

use App\Http\Requests\FormRequest;

class RestaurantGetRequest extends FormRequest
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
            'rating' => 'integer|min:0|max:5',
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
            'rating.integer' => 'The rating filter must be an integer',
            'rating.min' => 'The rating filter must be greater or equal than 0',
            'rating.max' => 'The rating filter must be less or equal than 5',
        ];
    }
}
