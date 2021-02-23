<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class inventaris_penghapusan
 * @package App\Models
 * @version November 19, 2019, 2:50 pm UTC
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
 * @property integer pid_penghapusan
 */
class inventaris_penghapusan extends Model
{
    // use SoftDeletes;
    protected $primaryKey = 'id_pk';


    public $table = 'inventaris_penghapusan';
    
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
        'tgl_perolehan',
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
        'pid_penghapusan',
        'status',
        'nomor_surat_persetujuan_bpkad',
        'harga_apprisal',
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
        'tgl_perolehan' => 'date',
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
        'id_pk' => 'integer',
        'pid_penghapusan' => 'integer',
        'harga_apprisal' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_pk' => 'required'
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

    public function getTglDibukukanAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    public function getTglPerolehanAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    /**
     * Harga apprisal setter
     */
    public function setHargaApprisalAttribute($value)
    {
        $this->attributes['harga_apprisal'] = str_replace('.', '', $value);
    }
}
