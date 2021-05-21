<?php

namespace App\Http\Requests\StockRequests;

use Illuminate\Foundation\Http\FormRequest;

class StockDeleteRequest extends FormRequest
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
            'ingredient_id' => 'required|integer|exists:ingredients,id'
        ];
    }
}