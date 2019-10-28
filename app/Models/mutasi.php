<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class mutasi
 * @package App\Models
 * @version October 28, 2019, 3:42 pm UTC
 *
 * @property integer opd_asal
 * @property integer opd_tujuan
 * @property string no_bast
 * @property string tgl_bast
 * @property integer idpegawai
 * @property string alasan_mutasi
 * @property string keterangan
 */
class mutasi extends Model
{
    use SoftDeletes;

    public $table = 'mutasi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'opd_asal',
        'opd_tujuan',
        'no_bast',
        'tgl_bast',
        'idpegawai',
        'alasan_mutasi',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'opd_asal' => 'integer',
        'opd_tujuan' => 'integer',
        'no_bast' => 'string',
        'tgl_bast' => 'date',
        'idpegawai' => 'integer',
        'alasan_mutasi' => 'string',
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
