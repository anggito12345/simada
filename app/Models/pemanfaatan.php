<?php

namespace App\Models;

use App\Traits\Draftable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class pemanfaatan
 * @package App\Models
 * @version October 15, 2019, 1:14 pm UTC
 *
 * @property integer pidinventaris
 * @property string peruntukan
 * @property integer umur
 * @property string no_perjanjian
 * @property string tgl_mulai
 * @property string tgl_akhir
 * @property integer mitra
 * @property string tipe_kontribusi
 * @property integer jumlah_kontribusi
 * @property integer pegawai
 * @property string aktif
 */
class pemanfaatan extends Model
{
    // use SoftDeletes;

    use Draftable;

    public $table = 'pemanfaatan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pidinventaris',
        'peruntukan',
        'umur',
        'umur_satuan',
        'no_perjanjian',
        'tgl_mulai',
        'tgl_akhir',
        'mitra',
        'tipe_kontribusi',
        'jumlah_kontribusi',
        'pegawai',
        'aktif',
        'tetap',
        'bagi_hasil',
        'draft'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pidinventaris' => 'integer',
        'peruntukan' => 'string',
        'umur' => 'integer',
        'umur_satuan' => 'string',
        'no_perjanjian' => 'string',
        'tgl_mulai' => 'date',
        'tgl_akhir' => 'date',
        'mitra' => 'integer',
        'tipe_kontribusi' => 'string',
        'jumlah_kontribusi' => 'integer',
        'pegawai' => 'integer',
        'aktif' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function setTglMulaiAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tgl_mulai'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTglMulaiAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    public function setTglAkhirAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tgl_akhir'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTglAkhirAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    
}
