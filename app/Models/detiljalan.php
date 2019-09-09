<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class detiljalan
 * @package App\Models
 * @version September 9, 2019, 3:32 pm UTC
 *
 * @property integer pidinventaris
 * @property string konstruksi
 * @property integer panjang
 * @property integer lebar
 * @property integer luas
 * @property string alamat
 * @property integer idkota
 * @property integer idkecamatan
 * @property integer idkelurahan
 * @property string koordinatlokasi
 * @property string koordinattanah
 * @property string tgldokumen
 * @property string nodokumen
 * @property string luastanah
 * @property string statustanah
 * @property string kodetanah
 * @property string keterangan
 * @property string dokumen
 * @property string foto
 */
class detiljalan extends Model
{
    use SoftDeletes;

    public $table = 'detil_jalan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pidinventaris',
        'konstruksi',
        'panjang',
        'lebar',
        'luas',
        'alamat',
        'idkota',
        'idkecamatan',
        'idkelurahan',
        'koordinatlokasi',
        'koordinattanah',
        'tgldokumen',
        'nodokumen',
        'luastanah',
        'statustanah',
        'kodetanah',
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
        'konstruksi' => 'string',
        'panjang' => 'integer',
        'lebar' => 'integer',
        'luas' => 'integer',
        'alamat' => 'string',
        'idkota' => 'integer',
        'idkecamatan' => 'integer',
        'idkelurahan' => 'integer',
        'koordinatlokasi' => 'string',
        'koordinattanah' => 'string',
        'tgldokumen' => 'date',
        'nodokumen' => 'string',
        'luastanah' => 'string',
        'statustanah' => 'string',
        'kodetanah' => 'string',
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
