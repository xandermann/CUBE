<?php

namespace App\Http\Requests\StockRequests;

use Illuminate\Foundation\Http\FormRequest;

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
            'quantity' => 'required|integer'
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
            'ingredient_id.required' => 'A ingredient id is required',
            'ingredient_id.exists' => "The ingredient id don't exist",
            'quantity.required' => 'A quantity number is required',
            'quantity.integer' => 'The quantity must be an integer'
        ];
    }
}
