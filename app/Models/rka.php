<?php

namespace App\Models;

use App\Traits\Draftable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class rka
 * @package App\Models
 * @version November 5, 2019, 1:50 pm UTC
 *
 * @property string no_spk
 * @property string no_bast
 */
class rka extends Model
{
    use Draftable;

    public $table = 'rka';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'no_spk',
        'no_bast',
        'nilai_kontrak',
        'created_by',
        'draft'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'no_spk' => 'string',
        'no_bast' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
