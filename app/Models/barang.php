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
    
}
