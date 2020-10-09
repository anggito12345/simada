<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="sys_workflow_master",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nama",
 *          description="nama",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="kondisi_1",
 *          description="kondisi_1",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="kondisi_2",
 *          description="kondisi_2",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="kondisi_3",
 *          description="kondisi_3",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="kondisi_4",
 *          description="kondisi_4",
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
 *      )
 * )
 */
class sys_workflow_master extends Model
{
    use SoftDeletes;

    public $table = 'sys_workflow_master';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'nama',
        'kondisi_1',
        'kondisi_2',
        'kondisi_3',
        'kondisi_4'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'kondisi_1' => 'string',
        'kondisi_2' => 'string',
        'kondisi_3' => 'string',
        'kondisi_4' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
