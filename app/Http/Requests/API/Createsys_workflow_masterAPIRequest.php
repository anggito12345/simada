<?php

namespace App\Http\Requests\API;

use App\Models\sys_workflow_master;
use InfyOm\Generator\Request\APIRequest;

class Createsys_workflow_masterAPIRequest extends APIRequest
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
        return sys_workflow_master::$rules;
    }
}
