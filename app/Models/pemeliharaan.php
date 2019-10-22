<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class pemeliharaan
 * @package App\Models
 * @version October 2, 2019, 4:29 pm UTC
 *
 * @property integer pidinventaris
 * @property string tgl
 * @property string uraian
 * @property string persh
 * @property string alamat
 * @property string nokontrak
 * @property string tglkontrak
 * @property integer biaya
 * @property integer menambah
 * @property string keterangan
 */
class pemeliharaan extends Model
{

    public $table = 'pemeliharaan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pidinventaris',
        'tgl',
        'uraian',
        'persh',
        'alamat',
        'nokontrak',
        'tglkontrak',
        'biaya',
        'menambah',
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
        'tgl' => 'date',
        'uraian' => 'string',
        'persh' => 'string',
        'alamat' => 'string',
        'nokontrak' => 'string',
        'tglkontrak' => 'date',
        'biaya' => 'integer',
        'menambah' => 'integer',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pidinventaris' => 'required'
    ];


    public function setTglAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tgl'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTglAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    public function setTglkontrakAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tglkontrak'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTglkontrakAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }


    
}
