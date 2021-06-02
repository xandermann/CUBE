<?php

namespace App\Http\Requests\MenuRequests;

use App\Http\Requests\FormRequest;

class MenuPostRequest extends FormRequest
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
            'dishes' => 'required|array',
            'dishes.*.id' => 'required|integer|exists:dishes,id|distinct',
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
            'name.required'  => 'The menu name is required',
            'name.string' => 'The menu name must be a string',
            'price.required'  => 'The menu price is required',
            'price.numeric' => 'The menu price must be numeric',
            'price.min' => 'The menu price must be greater than 0',
            'price.not_in' => 'The menu price must be different than 0',
            'dishes.required' => 'The dishes are required',
            'dishes.array' => 'The dishes must be in a array',
            'dishes.*.id.required' => 'The dishe id is required',
            'dishes.*.id.integer' => 'The dishe id must be a integer',
            'dishes.*.id.exists' => "The dishe id don't exist in dishe table",
            'dishes.*.id.distinct' => 'The dishe id must not have any duplicate',
        ];
    }
}
