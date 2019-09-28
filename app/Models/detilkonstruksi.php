<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class detilkonstruksi
 * @package App\Models
 * @version September 28, 2019, 2:10 pm UTC
 *
 * @property integer pidinventaris
 * @property string konstruksi
 * @property string bertingkat
 * @property string beton
 * @property integer luasbangunan
 * @property string alamat
 * @property integer idkota
 * @property integer idkecamatan
 * @property integer idkelurahan
 * @property string koordinatlokasi
 * @property string koordinattanah
 * @property string tglmulai
 * @property string tgldokumen
 * @property string nodokumen
 * @property integer luastanah
 * @property string statustanah
 * @property string kodetanah
 * @property string keterangan
 * @property string dokumen
 * @property string foto
 */
class detilkonstruksi extends Model
{
    

    public $table = 'detil_konstruksi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pidinventaris',
        'konstruksi',
        'bertingkat',
        'beton',
        'luasbangunan',
        'alamat',
        'idkota',
        'idkecamatan',
        'idkelurahan',
        'koordinatlokasi',
        'koordinattanah',
        'tglmulai',
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
        'bertingkat' => 'string',
        'beton' => 'string',
        'luasbangunan' => 'integer',
        'alamat' => 'string',
        'idkota' => 'integer',
        'idkecamatan' => 'integer',
        'idkelurahan' => 'integer',
        'koordinatlokasi' => 'string',
        'koordinattanah' => 'string',
        'tglmulai' => 'date',
        'tgldokumen' => 'date',
        'nodokumen' => 'string',
        'luastanah' => 'integer',
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

    public function setTgldokumenAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tgldokumen'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTgldokumenAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    public function setTglmulaiAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tglmulai'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTglmulaiAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }
    
}
