<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class organisasi
 * @package App\Models
 * @version September 8, 2019, 2:00 am UTC
 *
 * @property integer pid
 * @property string nama
 * @property string jenis
 * @property string alamat
 * @property integer aktif
 */
class organisasi extends Model
{
    public $table = 'm_organisasi';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'pid',
        'nama',
        'kode',
        'level',
        'alamat',
        'aktif',
        'setting',
        'jabatans'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pid' => 'integer',
        'nama' => 'string',
        'level' => 'integer',
        'alamat' => 'string',
        'aktif' => 'integer',
        'setting' => 'string',
        'jabatans' => 'string'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'kode' => 'unique:m_organisasi,kode'
    ];

    public function Organisasi()
    {
        return $this->hasOne('App\Models\organisasi', 'id', 'pid');
    }

    public function Jenisorganisasi()
    {
        return $this->hasOne('App\Models\jenisopd', 'id', 'jenis');
    }


}
