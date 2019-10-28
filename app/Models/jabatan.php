<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class jabatan
 * @package App\Models
 * @version October 19, 2019, 2:50 pm UTC
 *
 * @property string nama
 * @property integer jenis
 */
class jabatan extends Model
{
    // use SoftDeletes;

    public $table = 'm_jabatan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'level',
        'nama_jabatan',
        'kelompok'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'level' => 'integer',
        'nama_jabatan' => 'string',
        'kelompok' => 'integer'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
}
