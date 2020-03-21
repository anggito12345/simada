<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class inventaris_mutasi
 * @package App\Models
 * @version November 18, 2019, 3:45 pm UTC
 *
 * @property integer id
 * @property string noreg
 * @property integer pidbarang
 * @property string pidopd
 * @property integer pidlokasi
 * @property string tgl_sensus
 * @property integer volume
 * @property integer pembagi
 * @property integer harga_satuan
 * @property string perolehan
 * @property string kondisi
 * @property string lokasi_detil
 * @property integer umur_ekonomis
 * @property string keterangan
 * @property string tahun_perolehan
 * @property integer jumlah
 * @property string tgl_dibukukan
 * @property integer satuan
 * @property boolean draft
 * @property integer pidopd_cabang
 * @property integer pidupt
 * @property string kode_lokasi
 * @property integer alamat_propinsi
 * @property integer alamat_kota
 * @property integer idpegawai
 * @property integer pid_organisasi
 * @property string mutasi_at
 * @property string status
 */
class inventaris_mutasi extends Model
{
    // use SoftDeletes;


    protected $primaryKey = 'id_pk';

    public $table = 'inventaris_mutasi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'noreg',
        'pidbarang',
        'pidopd',
        'pidlokasi',
        'tgl_sensus',
        'volume',
        'pembagi',
        'harga_satuan',
        'perolehan',
        'kondisi',
        'lokasi_detil',
        'umur_ekonomis',
        'keterangan',
        'tahun_perolehan',
        'jumlah',
        'tgl_dibukukan',
        'satuan',
        'draft',
        'pidopd_cabang',
        'pidupt',
        'kode_lokasi',
        'alamat_propinsi',
        'alamat_kota',
        'alamat_kecamatan',
        'alamat_kelurahan',
        'idpegawai',
        'pid_organisasi',
        'mutasi_at',
        'mutasi_id',
        'status',
        'cancel_note',
        
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
        'tgl_sensus' => 'date',
        'volume' => 'integer',
        'pembagi' => 'integer',
        'harga_satuan' => 'integer',
        'perolehan' => 'string',
        'kondisi' => 'string',
        'lokasi_detil' => 'string',
        'umur_ekonomis' => 'integer',
        'keterangan' => 'string',
        'tahun_perolehan' => 'string',
        'jumlah' => 'integer',
        'tgl_dibukukan' => 'date',
        'satuan' => 'integer',
        'draft' => 'boolean',
        'pidopd_cabang' => 'integer',
        'pidupt' => 'integer',
        'kode_lokasi' => 'string',
        'alamat_propinsi' => 'integer',
        'alamat_kota' => 'integer',
        'alamat_kecamatan' => 'integer',
        'alamat_kelurahan' => 'bigint',
        'idpegawai' => 'integer',
        'pid_organisasi' => 'integer',
        'mutasi_at' => 'date',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function setTglSensusAttribute($value)
    {
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tgl_sensus'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTglSensusAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }


    public function setTglDibukukanAttribute($value)
    {        
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tgl_dibukukan'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }    

    public function getTglDibukukanAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }
    

    public function setMutasiAtAttribute($value)
    {        
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['mutasi_at'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }    

    public function getMutasiAtAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }
}
