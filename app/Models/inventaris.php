<?php

namespace App\Models;

use App\Traits\Draftable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        'kode_barang'
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

    public static function saveKib($dataKib, $tipe) {
        $rules = [];

        switch ($tipe) {
            case 'A':
                $rules = \App\Models\detiltanah::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                if(array_key_exists('koordinattanah', $dataKib) && is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
                }


                if (array_key_exists('tgl_sertifikat', $dataKib)) {
                    $dataKib['tgl_sertifikat'] = date("Y-m-d", strtotime($dataKib['tgl_sertifikat']));
                } else {
                    $dataKib['tgl_sertifikat'] = date('Y-m-d');
                }


                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_tanah')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_tanah')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_tanah')->insert($dataKib);
                break;
            case 'B':
                $rules = \App\Models\detilmesin::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_mesin')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_mesin')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_mesin')->insert($dataKib);

                break;
            case 'C':
                $rules = \App\Models\detilbangunan::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                if(isset($dataKib['koordinattanah']) && is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
                }

                if(array_key_exists('tgldokumen', $dataKib) && $dataKib['tgldokumen'] != '') {
                    $dataKib['tgldokumen'] = date("Y-m-d", strtotime($dataKib['tgldokumen']));
                } else {
                    $dataKib['tgldokumen'] = date('Y-m-d');
                }

                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_bangunan')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_bangunan')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_bangunan')->insert($dataKib);
                break;
            case 'D':
                $rules = \App\Models\detiljalan::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }


                if (isset($dataKib['panjang']))
                    $dataKib['panjang'] = str_replace('.', '', $dataKib['panjang']);
                if (isset($dataKib['lebar']))
                    $dataKib['lebar'] = str_replace('.', '', $dataKib['lebar']);
                if (isset($dataKib['luas']))
                    $dataKib['luas'] = str_replace('.', '', $dataKib['luas']);

                if(isset($dataKib['koordinattanah']) && is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
                }

                if (array_key_exists('tgldokumen', $dataKib) && $dataKib['tgldokumen'] != '') {
                    $dataKib['tgldokumen'] = date("Y-m-d", strtotime($dataKib['tgldokumen']));
                } else {
                    $dataKib['tgldokumen'] = date('Y-m-d');
                }

                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_jalan')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_jalan')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }
                DB::table('detil_jalan')->insert($dataKib);
                break;
            case 'E':
                $rules = \App\Models\detiljalan::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_aset_lainnya')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_aset_lainnya')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_aset_lainnya')->insert($dataKib);
                break;
            case 'F':
                $rules = \App\Models\detilkonstruksi::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                $dataKib['luasbangunan'] = str_replace('.', '', $dataKib['luasbangunan']);

                if(array_key_exists('koordinattanah', $dataKib) && is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
                }

                if(array_key_exists('tgl_dokumen', $dataKib) && $dataKib['tgl_dokumen'] != '') {
                    $dataKib['tgldokumen'] = date("Y-m-d", strtotime($dataKib['tgl_dokumen']));
                } else {
                    $dataKib['tgldokumen'] = date('Y-m-d');
                }

                if(array_key_exists('tglmulai', $dataKib) && $dataKib['tglmulai'] != '') {
                    $dataKib['tglmulai'] = date("Y-m-d", strtotime($dataKib['tglmulai']));
                } else {
                    $dataKib['tglmulai'] = date('Y-m-d');
                }


                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_konstruksi')->where('pidinventaris', $dataKib['pidinventaris'])->count();


                    if ($exist > 0 ) {
                        DB::table('detil_konstruksi')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_konstruksi')->insert($dataKib);
            default:
                break;
        }
    }

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
