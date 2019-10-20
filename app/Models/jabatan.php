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
        'jenis'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'jenis' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function Jenisopd()
    {
        return $this->hasOne('App\Models\jenisopd', 'id', 'jenis');
    }
    
}
