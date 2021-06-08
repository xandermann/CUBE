<?php

namespace App\Http\Requests\ComplaintRequests;

use App\Http\Requests\FormRequest;

class ComplaintPostRequest extends FormRequest
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
            'order_id' => 'required|integer|exists:orders,id',
            'message' => 'required|string',
            'date' => 'required|date',
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
            'order_id.required' => 'The order id is required',
            'order_id.integer' => 'The order id must be a integer',
            'order_id.exists' => "The order id don't exist in order table",
            'message.required' => 'The message is required',
            'message.string' => 'The message must be a string',
            'date.required' => 'The date is required',
            'date.date' => 'The date must be a date format',
        ];
    }
}
