<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class detilbangunan
 * @package App\Models
 * @version September 9, 2019, 1:58 pm UTC
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
 * @property string tgldokumen
 * @property string nodokumen
 * @property integer luastanah
 * @property string statustanah
 * @property string kodetanah
 * @property string dokumen
 * @property string keterangan
 * @property string foto
 */
class detilbangunan extends Model
{

    public $table = 'detil_bangunan';

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
        'tgldokumen',
        'nodokumen',
        'luastanah',
        'statustanah',
        'kodetanah',
        'keterangan',
        'nilai_hub',
        'tipe'
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
        'luasbangunan' => 'double',
        'alamat' => 'string',
        'idkota' => 'integer',
        'idkecamatan' => 'integer',
        'idkelurahan' => 'integer',
        'koordinatlokasi' => 'string',
        'koordinattanah' => 'string',
        'tgldokumen' => 'date',
        'nodokumen' => 'string',
        'luastanah' => 'integer',
        'statustanah' => 'string',
        'kodetanah' => 'string',
        'dokumen' => 'string',
        'keterangan' => 'string',
        'foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function Inventaris()
    {
        return $this->hasOne('App\Models\inventaris', 'id', 'pidinventaris');
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

    public function Statustanahmaster()
    {
        return $this->hasOne('App\Models\statustanah', 'id', 'statustanah');
    }

    public function Kodetanah()
    {
        return $this->hasOne('App\Models\detil_tanah', 'id', 'kodetanah');
    }

    public function setTgldokumenAttribute($value)
    {
        if ($value == null) {
            $value = date("Y-m-d");
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
}
