<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="inventaris_sensus",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="idinventaris",
 *          description="idinventaris",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="no_sk",
 *          description="no_sk",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="tanggal_sk",
 *          description="tanggal_sk",
 *          type="string"
 *      )
 * )
 */
class inventaris_sensus extends Model
{
    //use SoftDeletes;

    public $table = 'inventaris_sensus';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'idinventaris',
        'no_sk',
        'tanggal_sk',
        'status_barang_hilang',
        'status_barang',
        'status_approval',
        'created_by',
        'status_ubah_satuan',
        'kode_tujuan',
        'data_temporary'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'idinventaris' => 'integer',
        'no_sk' => 'string',
        'tanggal_sk' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
