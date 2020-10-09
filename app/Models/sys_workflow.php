<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="sys_workflow",
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
 *          property="trigger",
 *          description="trigger",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="pid_user",
 *          description="pid_user",
 *          type="integer",
 *          format="int32"
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
 *          property="do",
 *          description="do",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="seq_order",
 *          description="seq_order",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="data",
 *          description="data",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="data_do",
 *          description="data_do",
 *          type="string"
 *      )
 * )
 */
class sys_workflow extends Model
{
    use SoftDeletes;

    public $table = 'sys_workflow';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nama',
        'trigger',
        'pid_user',
        'do',
        'seq_order',
        'data',
        'data_do'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'trigger' => 'string',
        'pid_user' => 'integer',
        'do' => 'string',
        'seq_order' => 'integer',
        'data' => 'string',
        'data_do' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
