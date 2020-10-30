<?php

namespace App\Models;

use App\Traits\Draftable;
use App\Traits\SensusTrait;
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

    use SoftDeletes;
    use SensusTrait;
    use Draftable;

    public $table = 'inventaris';

    const INTRACODE = "01";
    const EXTRACODE = "02";
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'noreg',
        'pidbarang',
        'pidopd',
        'pidlokasi',
        'tahun_perolehan',
        'tgl_sensus',
        'volume',
        'pembagi',
        'satuan',
        'harga_satuan',
        'perolehan',
        'kondisi',
        'kode_lokasi',
        'lokasi_detil',
        'umur_ekonomis',
        'keterangan',
        'jumlah',
        'tgl_dibukukan',
        'pidopd_cabang',
        'pidupt',
        'draft',
        'alamat_kota',
        'alamat_propinsi',
        'alamat_kecamatan',
        'alamat_kelurahan',
        'idpegawai',
        'pid_organisasi',
        'kode_gedung',
        'kode_ruang',
        'penanggung_jawab',
        'umur_ekonomis',
        'kode_barang',
        'import_flag',
        'nama_populer',
        'id_sensus'
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
        'tahun_perolehan' => 'string',
        'tgl_sensus' => 'date',
        'volume' => 'integer',
        'pembagi' => 'integer',
        'satuan' => 'integer',
        'harga_satuan' => 'decimal:2',
        'perolehan' => 'string',
        'kondisi' => 'string',
        'tgl_dibukukan' => 'date',
        'jumlah' => 'int',
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
        'harga_satuan' => 'required',
        'jumlah' => 'required',
        'satuan' => 'required',
        'perolehan' => 'required',
        'kondisi' => 'required',
        'tahun_perolehan' => 'required'
    ];



    public static function CalculateIsIntraOrEkstra($tahun = 2000, $harga = 0) {

        if ($tahun >= 2015) {
            if ($harga > 1000000) {
                return self::INTRACODE;
            } else {
                return self::EXTRACODE;
            }
        } else if ($tahun >= 2011 && $tahun <= 2014) {
            /*if ($harga > 499999) {
                throw new \Exception("Harga harus dibawah 500rb!");
            }*/
        } else if ($tahun < 2011) {
            return self::INTRACODE;
        }
    }

    public function setHargaSatuanAttribute($value)
    {
        $secondValue = str_replace('.', '', $value);
        $this->attributes['harga_satuan'] = (float)str_replace(',', '.', $secondValue);
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

    public function Lokasi()
    {
        return $this->hasOne('App\Models\lokasi', 'id', 'pidlokasi');
    }

    public function Satuanmaster()
    {
        return $this->hasOne('App\Models\satuanbarang', 'id', 'satuan');
    }

    public function Barang()
    {
        return $this->hasOne('App\Models\barang', 'id', 'pidbarang');
    }

    public function Organisasi()
    {
        return $this->hasOne('App\Models\organisasi', 'id', 'pid_organisasi');
    }

    public function Organisasicabang()
    {
        return $this->hasOne('App\Models\organisasi', 'id', 'pidopd_cabang');
    }

    public function Organisasiupt()
    {
        return $this->hasOne('App\Models\organisasi', 'id', 'pidupt');
    }


    public function Kota()
    {
        return $this->hasOne('App\Models\alamat', 'id', 'alamat_kota');
    }

    public function Propinsi()
    {
        return $this->hasOne('App\Models\alamat', 'id', 'alamat_propinsi');
    }

    public function Kecamatan()
    {
        return $this->hasOne('App\Models\alamat', 'id', 'alamat_kecamatan');
    }

    public function Kelurahan()
    {
        return $this->hasOne('App\Models\alamat', 'id', 'alamat_kelurahan');
    }


}
