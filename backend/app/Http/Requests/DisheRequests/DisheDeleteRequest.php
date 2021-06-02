<?php

namespace App\Http\Requests\DisheRequests;

use App\Http\Requests\FormRequest;

class DisheDeleteRequest extends FormRequest
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
            'dishe_id' => 'required|integer|exists:dishes,id',
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
            'dishe_id.required' => 'The dishe id is required',
            'dishe_id.integer' => 'The dishe id must be a integer',
            'dishe_id.exists' => "The dishe id don't exist in dishe table",
        ];
    }
}
