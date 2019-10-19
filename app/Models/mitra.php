<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class mitra
 * @package App\Models
 * @version October 18, 2019, 11:44 pm UTC
 *
 * @property string npwp
 * @property string siup_tdp
 * @property string nama
 * @property string alamat
 * @property string telp
 * @property string email
 * @property string jenis_usaha
 * @property string pic
 * @property string jabatan_pic
 * @property string hp_pic
 * @property string email_pic
 * @property integer aktf
 */
class mitra extends Model
{
    // use SoftDeletes;

    public $table = 'm_mitra';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'npwp',
        'siup_tdp',
        'nama',
        'alamat',
        'telp',
        'email',
        'jenis_usaha',
        'pic',
        'jabatan_pic',
        'hp_pic',
        'email_pic',
        'aktf'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'npwp' => 'string',
        'siup_tdp' => 'string',
        'nama' => 'string',
        'alamat' => 'string',
        'telp' => 'string',
        'email' => 'string',
        'jenis_usaha' => 'string',
        'pic' => 'string',
        'jabatan_pic' => 'string',
        'hp_pic' => 'string',
        'email_pic' => 'string',
        'aktf' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
