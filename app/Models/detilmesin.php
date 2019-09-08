<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class detilmesin
 * @package App\Models
 * @version September 8, 2019, 3:02 pm UTC
 *
 * @property integer id
 * @property integer pidinventaris
 * @property integer merk
 * @property string ukuran
 * @property string bahan
 * @property string nopabrik
 * @property string norangka
 * @property string nomesin
 * @property string nopol
 * @property string bpkb
 * @property string keterangan
 * @property string dokumen
 * @property string foto
 */
class detilmesin extends Model
{

    public $table = 'detil_mesin';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'pidinventaris',
        'merk',
        'ukuran',
        'bahan',
        'nopabrik',
        'norangka',
        'nomesin',
        'nopol',
        'bpkb',
        'keterangan',
        'dokumen',
        'foto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pidinventaris' => 'integer',
        'merk' => 'integer',
        'ukuran' => 'string',
        'bahan' => 'string',
        'nopabrik' => 'string',
        'norangka' => 'string',
        'nomesin' => 'string',
        'nopol' => 'string',
        'bpkb' => 'string',
        'keterangan' => 'string',
        'dokumen' => 'string',
        'foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
