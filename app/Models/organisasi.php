<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class organisasi
 * @package App\Models
 * @version September 4, 2019, 4:10 pm UTC
 *
 * @property integer pid
 * @property string nama
 * @property string jenis
 * @property string alamat
 * @property integer aktif
 */
class organisasi extends Model
{
    public $table = 'm_organisasi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pid',
        'nama',
        'jenis',
        'alamat',
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
        'jenis' => 'string',
        'alamat' => 'string',
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
