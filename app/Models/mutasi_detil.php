<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class mutasi_detil
 * @package App\Models
 * @version October 28, 2019, 3:43 pm UTC
 *
 * @property integer pid
 * @property integer inventaris
 * @property string keterangan
 */
class mutasi_detil extends Model
{
    // use SoftDeletes;

    public $table = 'mutasi_detil';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pid',
        'inventaris',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pid' => 'integer',
        'inventaris' => 'integer',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
