<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class RestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false; // TODO - Corentin => quelle permission faut-il pour créer un restaurant ?
        //true pour l'instant pour les tests
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
            // TODO rules
        ];
    }
}
