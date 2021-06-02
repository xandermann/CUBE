<?php

namespace App\Http\Requests\DisheRequests;

use App\Http\Requests\FormRequest;

class DishePostRequest extends FormRequest
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
            'name' => 'required|string',
            'price' => 'required|numeric|min:0|not_in:0',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|integer|exists:ingredients,id|distinct',
            'ingredients.*.quantity' => 'required|integer|min:0',
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
            'name.required'  => 'The dishe name is required',
            'name.string' => 'The dishe name must be a string',
            'price.required'  => 'The dishe price is required',
            'price.numeric' => 'The dishe price must be numeric',
            'price.min' => 'The dishe price must be greater than 0',
            'price.not_in' => 'The dishe price must be different than 0',
            'ingredients.required' => 'The ingredients are required',
            'ingredients.array' => 'The ingredients must be in a array',
            'ingredients.*.id.required' => 'The ingredient id is required',
            'ingredients.*.id.integer' => 'The ingredient id must be a integer',
            'ingredients.*.id.exists' => "The ingredient id don't exist in ingredient table",
            'ingredients.*.id.distinct' => 'The ingredient id must not have any duplicate',
            'ingredients.*.quantity.required' => 'The quantity of ingredient is required',
            'ingredients.*.quantity.integer' => 'The quantity of ingredient must be a integer',
            'ingredients.*.quantity.min' => 'The quantity of ingredient must be greater than 0',
        ];
    }
}
