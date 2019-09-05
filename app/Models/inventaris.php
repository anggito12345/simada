<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class inventaris
 * @package App\Models
 * @version September 5, 2019, 2:24 pm UTC
 *
 * @property string noreg
 * @property integer pidbarang
 * @property string pidopd
 * @property integer pidlokasi
 * @property string tgl_perolehan
 * @property string tgl_sensus
 * @property integer volume
 * @property integer pembagi
 * @property string satuan
 * @property integer harga_satuan
 * @property string perolehan
 * @property string kondisi
 * @property string lokasi_detil
 * @property integer umur_ekonomis
 * @property string keterangan
 */
class inventaris extends Model
{

    public $table = 'inventaris';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'noreg',
        'pidbarang',
        'pidopd',
        'pidlokasi',
        'tgl_perolehan',
        'tgl_sensus',
        'volume',
        'pembagi',
        'satuan',
        'harga_satuan',
        'perolehan',
        'kondisi',
        'lokasi_detil',
        'umur_ekonomis',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'noreg' => 'string',
        'pidbarang' => 'integer',
        'pidopd' => 'string',
        'pidlokasi' => 'integer',
        'tgl_perolehan' => 'date',
        'tgl_sensus' => 'date',
        'volume' => 'integer',
        'pembagi' => 'integer',
        'satuan' => 'string',
        'harga_satuan' => 'integer',
        'perolehan' => 'string',
        'kondisi' => 'string',
        'lokasi_detil' => 'string',
        'umur_ekonomis' => 'integer',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    public function setTglPerolehanAttribute($value)
    {
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tgl_perolehan'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }

    public function setTglSensusAttribute($value)
    {
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tgl_sensus'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }

    public function Lokasi()
    {
        return $this->hasOne('App\Models\lokasi', 'id', 'pidlokasi');
    }

    public function Barang()
    {
        return $this->hasOne('App\Models\barang', 'id', 'pidbarang');
    }

    public function Organisasi()
    {
        return $this->hasOne('App\Models\organisasi', 'id', 'pidopd');
    }

    
}
