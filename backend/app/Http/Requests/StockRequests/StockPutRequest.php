<?php

namespace App\Http\Requests\StockRequests;

use App\Http\Requests\FormRequest;

class StockPutRequest extends FormRequest
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
            'ingredient_id' => 'required|integer|exists:ingredients,id',
            'quantity' => 'required|integer|min:0'
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
            'quantity.required'  => 'A quantity is required',
            'quantity.integer' => 'The quantity must be an integer',
            'quantity.min' => 'The quantity must be greater than 0',
            'ingredient_id.required' => 'A ingredient id is required',
            'ingredient_id.integer' => 'A ingredient id must be an integer',
            'ingredient_id.exists' => "The ingredient id don't exist",
        ];
    }
}
