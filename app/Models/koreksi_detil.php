<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class koreksi_detil
 * @package App\Models
 * @version January 24, 2020, 9:27 am UTC
 *
 * @property string title
 */
class koreksi_detil extends Model
{
    public $table = 'koreksi_detil';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // protected $dates = ['deleted_at'];

    public $fillable = [
        'idkoreksi',
        'pidinventaris',
        'harga_satuan_lama',
        'harga_satuan_baru',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'idkoreksi' => 'integer',
        'pidinventaris' => 'integer',
        'harga_satuan_lama' => 'integer',
        'harga_satuan_baru' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * Harga satuan baru setter
     */
    public function setHargaSatuanBaruAttribute($value)
    {
        $this->attributes['harga_satuan_baru'] = str_replace('.', '', $value);
    }

}
