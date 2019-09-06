<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class pemeliharaan
 * @package App\Models
 * @version September 5, 2019, 2:21 pm UTC
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
        
    ];


    public function setTglAttribute($value)
    {
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tgl'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }

    public function setTglkontrakAttribute($value)
    {
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tglkontrak'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }

    public function Inventaris()
    {
        return $this->hasOne('App\Models\inventaris', 'id', 'pidinventaris');
    }

    
}
