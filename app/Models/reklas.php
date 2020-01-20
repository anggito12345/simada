<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Draftable;
// use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class reklas
 * @package App\Models
 * @version January 19, 2020, 12:58 am UTC
 *
 * @property string nosurat
 * @property string tglsurat
 * @property string nosurat_persetujuan
 * @property string tglsurat_persetujuan
 * @property string draft
 * @property integer created_by
 */
class reklas extends Model
{
    // use SoftDeletes;
    use Draftable;

    public $table = 'reklas';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'nosurat',
        'tglsurat',
        'nosurat_persetujuan',
        'tglsurat_persetujuan',
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
        'nosurat' => 'string',
        'tglsurat' => 'date',
        'nosurat_persetujuan' => 'string',
        'tglsurat_persetujuan' => 'string',
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
     * Tanggal surat setter
     */
    public function setTglsuratAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tglsurat'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    /**
     * Tanggal surat getter
     */
    public function getTglsuratAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    
}
