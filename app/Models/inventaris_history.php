<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class inventaris_history
 * @package App\Models
 * @version December 3, 2019, 2:14 pm UTC
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
 * @property integer satuan
 * @property boolean draft
 * @property integer pidopd_cabang
 * @property integer pidupt
 * @property string kode_lokasi
 * @property integer alamat_propinsi
 * @property integer alamat_kota
 * @property integer idpegawai
 * @property integer pid_organisasi
 * @property string kode_gedung
 * @property string kode_ruang
 * @property integer penanggung_jawab
 * @property integer umur_ekonomis
 * @property string action
 * @property string history_at
 */
class inventaris_history extends Model
{
    use SoftDeletes;

    public $table = 'inventaris_history';
    
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
        'kode_gedung',
        'kode_ruang',
        'penanggung_jawab',
        'umur_ekonomis',
        'action',
        'history_at'
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
        'harga_satuan' => 'decimal:2',
        'perolehan' => 'string',
        'kondisi' => 'string',
        'lokasi_detil' => 'string',
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
        'kode_gedung' => 'string',
        'kode_ruang' => 'string',
        'penanggung_jawab' => 'integer',
        'umur_ekonomis' => 'integer',
        'action' => 'string',
        'history_at' => 'date',
        'idhistory' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function setHistoryAtAttribute($value)
    {
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['history_at'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }

    public function getHistoryAtAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

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

    
}
