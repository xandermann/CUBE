<?php

namespace App\Http\Requests\OrderRequests;

use App\Http\Requests\FormRequest;

class OrderPostRequest extends FormRequest
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
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            // 'user_id' => 'required|integer|exists:users,id',
            'date' => 'required|date',
            'dishes' => 'present|array',
            'dishes.*.id' => 'required|integer|exists:dishes,id|distinct',
            'dishes.*.quantity' => 'required|integer|min:0',
            'menus' => 'present|array',
            'menus.*.id' => 'required|integer|exists:menus,id|distinct',
            'menus.*.quantity' => 'required|integer|min:0',
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
            'restaurant_id.required' => 'The restaurant id is required',
            'restaurant_id.integer' => 'The restaurant id must be a integer',
            'restaurant_id.exists' => "The restaurant id don't exist in restaurant table",
            'user_id.required' => 'The user id is required',
            'user_id.integer' => 'The user id must be a integer',
            'user_id.exists' => "The user id don't exist in user table",
            'date.required' => 'The date is required',
            'date.date' => 'The date must be a date format',
            'dishes.required' => 'The dishes are required',
            'dishes.array' => 'The dishes must be in a array',
            'dishes.*.id.required' => 'The dishe id is required',
            'dishes.*.id.integer' => 'The dishe id must be a integer',
            'dishes.*.id.exists' => "The dishe id don't exist in dishe table",
            'dishes.*.id.distinct' => 'The dishe id must not have any duplicate',
            'dishes.*.quantity.required' => 'The quantity of dishes is required',
            'dishes.*.quantity.integer' => 'The quantity of dishes must be an integer',
            'dishes.*.quantity.min' => 'The quantity of dishes must be greater than or equal to 0',
            'menus.required' => 'The menus are required',
            'menus.array' => 'The menus must be in a array',
            'menus.*.id.required' => 'The menu id is required',
            'menus.*.id.integer' => 'The menu id must be a integer',
            'menus.*.id.exists' => "The menu id don't exist in menu table",
            'menus.*.id.distinct' => 'The menu id must not have any duplicate',
            'menus.*.quantity.required' => 'The quantity of menus is required',
            'menus.*.quantity.integer' => 'The quantity of menus must be an integer',
            'menus.*.quantity.min' => 'The quantity of menus must be greater than or equal to 0',
        ];
    }
}
