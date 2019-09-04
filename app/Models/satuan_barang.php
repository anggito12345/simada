<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class satuan_barang
 * @package App\Models
 * @version September 4, 2019, 4:35 pm UTC
 *
 * @property string nama
 * @property integer aktif
 * @property integer bisadibagi
 */
class satuan_barang extends Model
{

    public $table = 'm_satuan_barang';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'aktif',
        'bisadibagi'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'aktif' => 'integer',
        'bisadibagi' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
