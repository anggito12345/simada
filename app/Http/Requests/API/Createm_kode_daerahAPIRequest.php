<?php

namespace App\Http\Requests\API;

use App\Models\m_kode_daerah;
use InfyOm\Generator\Request\APIRequest;

class Createm_kode_daerahAPIRequest extends APIRequest
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
        return m_kode_daerah::$rules;
    }
}
