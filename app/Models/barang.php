<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class barang
 * @package App\Models
 * @version September 4, 2019, 3:42 pm UTC
 *
 * @property integer pid
 * @property string kodetampil
 * @property string kode_rek
 * @property string nama_rek_aset
 * @property integer jenis_barang
 * @property integer umur_ekononomis
 * @property string aset
 * @property string obyek
 * @property string rincianobyek
 * @property string subrincianobyek
 */
class barang extends Model
{

    public $table = 'm_barang';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_rek_aset',
        'umur_ekonomis',
        'kode_akun',
        'kode_kelompok',
        'kode_objek',
        'kode_rincian_objek',
        'kode_sub_rincian_objek',
        'kode_sub_sub_rincian_objek',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama_rek_aset' => 'string',
        'kode_akun' => 'string',
        'kode_kelompok' => 'string',
        'kode_rincian_objek' => 'string',
        'kode_sub_rincian_objek' => 'string',
        'kode_sub_sub_rincian_objek' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * Build kode barang string
     * @param object $barang
     * @return string
     */
    public static function buildKodeBarang($barang = null)
    {
        $kodeBarang = "";
        if (isset($barang->kode_akun) && strlen($barang->kode_akun) != 0) {
            $kodeBarang .= $barang->kode_akun;
        }

        if (isset($barang->kode_kelompok) && strlen($barang->kode_kelompok) != 0) {
            $kodeBarang .= ".{$barang->kode_kelompok}";
        }

        if (isset($barang->kode_jenis) && strlen($barang->kode_jenis) != 0) {
            $kodeBarang .= ".{$barang->kode_jenis}";
        }

        if (isset($barang->kode_objek) && strlen($barang->kode_objek) != 0) {
            $kodeBarang .= ".{$barang->kode_objek}";
        }

        if (isset($barang->kode_rincian_objek) && strlen($barang->kode_rincian_objek) != 0) {
            $kodeBarang .= ".{$barang->kode_rincian_objek}";
        }

        if (isset($barang->kode_sub_rincian_objek) && strlen($barang->kode_sub_rincian_objek) != 0) {
            $kodeBarang .= ".{$barang->kode_sub_rincian_objek}";
        }

        if (isset($barang->kode_sub_sub_rincian_objek) && strlen($barang->kode_sub_sub_rincian_objek) != 0) {
            $kodeBarang .= ".{$barang->kode_sub_sub_rincian_objek}";
        }

        return $kodeBarang;
    }
    
}
