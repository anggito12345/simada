<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\alamat;

class CreatealamatRequest extends FormRequest
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
        $al = new \App\Models\alamat();
        $al->kode = $this->kode;
        $al->jenis = $this->jenis;
        return $al->rules();
    }
}
