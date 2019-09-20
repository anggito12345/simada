<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class system_upload
 * @package App\Models
 * @version September 18, 2019, 4:57 pm UTC
 *
 * @property string uid
 * @property string name
 * @property string type
 * @property integer size
 * @property string path
 */
class system_upload extends Model
{

    public $table = 'system_upload';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'uid',
        'name',
        'type',
        'size',
        'path',
        'keterangan',
        'jenis',
        'foreign_field',
        'foreign_value',
        'foreign_id',
        'table'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'uid' => 'string',
        'name' => 'string',
        'type' => 'string',
        'size' => 'integer',
        'path' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
