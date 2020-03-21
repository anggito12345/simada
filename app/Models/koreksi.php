<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Draftable;
// use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class koreksi
 * @package App\Models
 * @version January 24, 2020, 9:13 am UTC
 *
 * @property string title
 */
class koreksi extends Model
{
    // use SoftDeletes;
    use Draftable;

    public $table = 'koreksi';
    

    // protected $dates = ['deleted_at'];

    public $fillable = [
        'tglkoreksi',
        'draft',
        'created_by',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tglkoreksi' => 'string',
        'draft' => 'string',
        'created_by' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * Tanggal koreksi setter
     */
    public function setTglkoreksiAttribute($value)
    {
        $value = date("Y-m-d", strtotime($value));
        $this->attributes['tglkoreksi'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    /**
     * Tanggal koreksi getter
     */
    public function getTglkoreksiAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    
}
