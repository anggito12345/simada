<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class rka_detil
 * @package App\Models
 * @version November 5, 2019, 1:51 pm UTC
 *
 * @property integer pid
 * @property string no_rka
 * @property integer nilai_kontrak
 * @property string keterangan
 */
class rka_detil extends Model
{
    // use SoftDeletes;

    public $table = 'rka_detil';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pid',
        'kode_barang',
        'jumlah_real',
        'harga_satuan_real',
        'nilai_kontrak',
        'kib',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pid' => 'integer',
        'kode_barang' => 'integer',
        'jumlah_real' => 'integer',
        'harga_satuan_real' => 'float',
        'nilai_kontrak' => 'float',
        'kib' => 'string',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
