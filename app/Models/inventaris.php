<?php

namespace App\Models;

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

    public $table = 'inventaris';
    
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
        'lokasi_detil',
        'umur_ekonomis',
        'keterangan',
        'jumlah',
        'tgl_dibukukan',
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
        'harga_satuan' => 'integer',
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

                if(is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
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
                $rules = \App\Models\detiltanah::$rules;
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
            case 'C':
                $rules = \App\Models\detilbangunan::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                if(is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
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

                $dataKib['panjang'] = str_replace('.', '', $dataKib['panjang']);
                $dataKib['lebar'] = str_replace('.', '', $dataKib['lebar']);
                $dataKib['luas'] = str_replace('.', '', $dataKib['luas']);

                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {                    
                    $exist = DB::table('detil_jalan')->where('pidinventaris', $dataKib['pidinventaris'])->count();
                    
                    if ($exist > 0 ) {
                        DB::table('detil_jalan')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                } 

                DB::table('detil_jalan')->insert($dataKib);
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
            case 'F':
                $rules = \App\Models\detilkonstruksi::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                $dataKib['luasbangunan'] = str_replace('.', '', $dataKib['luasbangunan']);

                if(is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
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

    public function setHargaSatuanAttribute($value)
    {
        $this->attributes['harga_satuan'] = str_replace('.', '', $value);
    }

    public function setTglSensusAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
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
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tgl_dibukukan'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
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
        return $this->hasOne('App\Models\organisasi', 'id', 'pidopd');
    }

    
}
