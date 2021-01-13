<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule; 

/**
 * Class alamat
 * @package App\Models
 * @version September 7, 2019, 1:37 pm UTC
 *
 * @property integer pid
 * @property string nama
 * @property string jenis
 * @property string kodepos
 */
class alamat extends Model
{

    public $table = 'm_alamat';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pid',
        'nama',
        'jenis',
        'kodepos',
        'kode',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'bigint',
        'pid' => 'integer',
        'nama' => 'string',
        'jenis' => 'string',
        'kodepos' => 'string',
        'kode' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public function rules() {
        $self = $this;
        return  [
            'kode' => [
                'required',
                Rule::unique('m_alamat')->where(function ($query) {
                    return $query->whereRaw("jenis = '".$this->jenis."' AND kode = '".$this->kode."'");                                         
                }),
            ]
        ];
    }

    public function Alamat()
    {
        return $this->hasOne('App\Models\alamat', 'id', 'pid');
    }
}
