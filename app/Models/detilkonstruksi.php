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
        'kodetanah' => 'integer',
        'keterangan' => 'string',
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
        if ($value == null) {
            $value = date("d-m-Y");
        }

        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tgldokumen'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
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
        if ($value == null) {
            $value = date("d-m-Y");
        }

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
    
    public function Kota()
    {
        return $this->hasOne('App\Models\alamat', 'id', 'idkota');
    }

    public function Kecamatan()
    {
        return $this->hasOne('App\Models\alamat', 'id', 'idkecamatan');
    }

    public function Kelurahan()
    {
        return $this->hasOne('App\Models\alamat', 'id', 'idkelurahan');
    }

    public function Statustanah()
    {
        return $this->hasOne('App\Models\statustanah', 'id', 'statustanah');
    }

    public function Detiltanah()
    {
        return $this->hasOne('App\Models\detil_tanah', 'id', 'kodetanah');
    }
}
