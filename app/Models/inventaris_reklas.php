<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class inventaris_reklas
 * @package App\Models
 * @version December 23, 2019, 1:56 pm UTC
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
 * @property string keterangan
 * @property string tahun_perolehan
 * @property integer jumlah
 * @property string tgl_dibukukan
 * @property string tgl_perolehan
 * @property integer satuan
 * @property integer pidopd_cabang
 * @property integer pidupt
 * @property string kode_lokasi
 * @property integer alamat_propinsi
 * @property integer alamat_kota
 * @property integer alamat_kecamatan
 * @property integer alamat_kelurahan
 * @property integer idpegawai
 * @property integer pid_organisasi
 * @property string kode_gedung
 * @property string kode_ruang
 * @property integer penanggung_jawab
 * @property integer umur_ekonomis
 * @property string draft
 * @property integer created_by
 * @property string reklas_at
 */
class inventaris_reklas extends Model
{
    // use SoftDeletes;

    public $table = 'inventaris_reklas';
    
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
        'keterangan',
        'tahun_perolehan',
        'jumlah',
        'tgl_dibukukan',
        'tgl_perolehan',
        'satuan',
        'pidopd_cabang',
        'pidupt',
        'kode_lokasi',
        'alamat_propinsi',
        'alamat_kota',
        'alamat_kecamatan',
        'alamat_kelurahan',
        'idpegawai',
        'pid_organisasi',
        'kode_gedung',
        'kode_ruang',
        'penanggung_jawab',
        'umur_ekonomis',
        'draft',
        'created_by',
        'reklas_at',
        'status',
        'idbarangtarget',
        'tipe_kib'
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
        'keterangan' => 'string',
        'tahun_perolehan' => 'string',
        'jumlah' => 'integer',
        'tgl_dibukukan' => 'date',
        'tgl_perolehan' => 'date',
        'satuan' => 'integer',
        'pidopd_cabang' => 'integer',
        'pidupt' => 'integer',
        'kode_lokasi' => 'string',
        'alamat_propinsi' => 'integer',
        'alamat_kota' => 'integer',
        'alamat_kecamatan' => 'integer',
        'alamat_kelurahan' => 'integer',
        'idpegawai' => 'integer',
        'pid_organisasi' => 'integer',
        'kode_gedung' => 'string',
        'kode_ruang' => 'string',
        'penanggung_jawab' => 'integer',
        'umur_ekonomis' => 'integer',
        'draft' => 'string',
        'id_pk' => 'integer',
        'created_by' => 'integer',
        'reklas_at' => 'date'
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
        $this->attributes['tgl_sensus'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }

    public function getTglSensusAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    public function setTglPerolehanAttribute($value)
    {        
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tgl_perolehan'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }

    public function setTglDibukukanAttribute($value)
    {        
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tgl_dibukukan'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }    

    public function getTglPerolehanAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    public function getTglDibukukanAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }
    

    public function setReklasAtAttribute($value)
    {        
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['reklas_at'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }    

    public function getReklasAtAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }
    
}
