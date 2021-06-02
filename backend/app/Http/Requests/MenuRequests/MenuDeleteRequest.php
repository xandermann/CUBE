<?php

namespace App\Http\Requests\MenuRequests;

use App\Http\Requests\FormRequest;

class MenuDeleteRequest extends FormRequest
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
            'menu_id' => 'required|integer|exists:menus,id',
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
            'menu_id.required' => 'The menu id is required',
            'menu_id.integer' => 'The menu id must be a integer',
            'menu_id.exists' => "The menu id don't exist in menu table",
        ];
    }
}
