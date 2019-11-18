<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class module_access
 * @package App\Models
 * @version November 13, 2019, 2:12 pm UTC
 *
 * @property string nama
 * @property integer pid
 */
class module_access extends Model
{
    // use SoftDeletes;

    public $table = 'module_access';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'kode_module',
        'pid_jabatan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
