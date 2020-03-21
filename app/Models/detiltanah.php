<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class detiltanah
 * @package App\Models
 * @version September 8, 2019, 1:28 pm UTC
 *
 * @property integer pidinventaris
 * @property integer luas
 * @property string alamat
 * @property integer idkota
 * @property integer idkecamatan
 * @property integer idkelurahan
 * @property string koordinatlokasi
 * @property string koordinattanah
 * @property string hak
 * @property string status_sertifikat
 * @property string tgl_sertifikat
 * @property string nomor_sertifikat
 * @property string penggunaan
 * @property string keterangan
 * @property string dokumen
 * @property string foto
 */
class detiltanah extends Model
{

    public $table = 'detil_tanah';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pidinventaris',
        'luas',
        'alamat',
        'idkota',
        'idkecamatan',
        'idkelurahan',
        'koordinatlokasi',
        'koordinattanah',
        'hak',
        'status_sertifikat',
        'tgl_sertifikat',
        'nomor_sertifikat',
        'penggunaan',
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
        'luas' => 'integer',
        'alamat' => 'string',
        'idkota' => 'integer',
        'idkecamatan' => 'integer',
        'idkelurahan' => 'integer',
        'koordinatlokasi' => 'string',
        'koordinattanah' => 'string',
        'hak' => 'string',
        'status_sertifikat' => 'string',
        'tgl_sertifikat' => 'date',
        'nomor_sertifikat' => 'string',
        'penggunaan' => 'string',
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

    public function setTglSertifikatAttribute($value)
    {
        if ($value == null) {
            $value = date("Y-m-d");
        }
        
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tgl_sertifikat'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }

    public function getTglSertifikatAttribute($value)
    {
        if ($value == "") {
            return date("d/m/Y");
        }

        return date("d/m/Y", strtotime($value));
    }

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
    
}
