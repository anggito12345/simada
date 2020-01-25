<?php

namespace App\Http\Requests\API;

use App\Models\koreksi;
use InfyOm\Generator\Request\APIRequest;

class UpdatekoreksiAPIRequest extends APIRequest
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
        $rules = koreksi::$rules;
        
        return $rules;
    }
}
