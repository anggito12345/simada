<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class reklas_detil
 * @package App\Models
 * @version January 20, 2020, 9:55 am UTC
 *
 * @property string title
 */
class reklas_detil extends Model
{
    // use SoftDeletes;

    public $table = 'reklas_detil';
   
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'idreklas',
        'pidinventaris',
        'pidbarang_tujuan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'idreklas' => 'integer',
        'pidbarang_tujuan' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
