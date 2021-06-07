<?php

namespace App\Http\Requests\ReviewRequests;

use App\Http\Requests\FormRequest;

class ReviewPostRequest extends FormRequest
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
            'note' => ['required', 'regex:/^((?:[0-4](\.\d)?)|(?:5(\.0)?)){1}$/'],
            'message' => 'required|string',
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
            'restaurant_id.integer' => 'The restaurant id must be an integer',
            'restaurant_id.exists' => "The restaurant id don't exist in order table",
            'note.required' => 'The note is required',
            'note.regex' => 'The note must be a double value between 0 and 5 with only one decimal digit',
            'message.required' => 'The message is required',
            'message.string' => 'The message must be a string',
        ];
    }
}
