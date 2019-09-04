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
        'pid',
        'kodetampil',
        'kode_rek',
        'nama_rek_aset',
        'jenis_barang',
        'umur_ekononomis',
        'aset',
        'obyek',
        'rincianobyek',
        'subrincianobyek'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pid' => 'integer',
        'kodetampil' => 'string',
        'kode_rek' => 'string',
        'nama_rek_aset' => 'string',
        'jenis_barang' => 'integer',
        'umur_ekononomis' => 'integer',
        'aset' => 'string',
        'obyek' => 'string',
        'rincianobyek' => 'string',
        'subrincianobyek' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
