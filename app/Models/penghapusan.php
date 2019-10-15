<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class penghapusan
 * @package App\Models
 * @version October 2, 2019, 4:30 pm UTC
 *
 * @property integer pidinventaris
 * @property string noreg
 * @property string tglhapus
 * @property string kriteria
 * @property string kondisi
 * @property string harga_apprisal
 * @property string dokumen
 * @property string foto
 * @property string nosk
 * @property string tglsk
 * @property string keterangan
 */
class penghapusan extends Model
{
    // use SoftDeletes;

    public $table = 'penghapusan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pidinventaris',
        'noreg',
        'tglhapus',
        'kriteria',
        'kondisi',
        'harga_apprisal',
        // 'dokumen',
        // 'foto',
        'nosk',
        'tglsk',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pidinventaris' => 'integer',
        'noreg' => 'string',
        'tglhapus' => 'date',
        'kriteria' => 'string',
        'kondisi' => 'string',
        'harga_apprisal' => 'string',
        // 'dokumen' => 'string',
        // 'foto' => 'string',
        'nosk' => 'string',
        'tglsk' => 'date',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    public function setTglskAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tglsk'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTglskAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    public function setTglhapusAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tglhapus'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTglhapusAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }
    
}
