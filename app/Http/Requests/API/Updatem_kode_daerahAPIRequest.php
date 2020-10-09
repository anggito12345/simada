<?php

namespace App\Http\Requests\API;

use App\Models\m_kode_daerah;
use InfyOm\Generator\Request\APIRequest;

class Updatem_kode_daerahAPIRequest extends APIRequest
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
        $rules = m_kode_daerah::$rules;
        
        return $rules;
    }
}
