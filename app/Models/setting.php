<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class setting
 * @package App\Models
 * @version October 20, 2019, 12:11 pm UTC
 *
 * @property string nama
 * @property string nilai
 * @property boolean aktif
 */
class setting extends Model
{
    // use SoftDeletes;

    public $table = 'system_setting';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'nilai',
        'aktif'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'nilai' => 'string',
        'aktif' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
