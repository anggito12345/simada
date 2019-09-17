<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class alamat
 * @package App\Models
 * @version September 7, 2019, 1:37 pm UTC
 *
 * @property integer pid
 * @property string nama
 * @property string jenis
 * @property string kodepos
 */
class alamat extends Model
{

    public $table = 'm_alamat';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pid',
        'nama',
        'jenis',
        'kodepos'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pid' => 'integer',
        'nama' => 'string',
        'jenis' => 'string',
        'kodepos' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function Alamat()
    {
        return $this->hasOne('App\Models\alamat', 'id', 'pid');
    }
}
