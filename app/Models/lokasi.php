<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class lokasi
 * @package App\Models
 * @version September 4, 2019, 4:14 pm UTC
 *
 * @property integer pid
 * @property string nama
 * @property integer aktif
 */
class lokasi extends Model
{

    public $table = 'm_lokasi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pid',
        'nama',
        'aktif'
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
        'aktif' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
