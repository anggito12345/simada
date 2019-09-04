<?php

namespace App\Http\Requests\API;

use App\Models\satuan_barang;
use InfyOm\Generator\Request\APIRequest;

class Updatesatuan_barangAPIRequest extends APIRequest
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
        return satuan_barang::$rules;
    }
}
