<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="rka_barang",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="kode_organisasi",
 *          description="kode_organisasi",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="nama_organisasi",
 *          description="nama_organisasi",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tahun_rka",
 *          description="tahun_rka",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="kode_barang",
 *          description="kode_barang",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="nama_barang",
 *          description="nama_barang",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="jumlah",
 *          description="jumlah",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="harga_satuan",
 *          description="harga_satuan",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="nilai",
 *          description="nilai",
 *          type="number",
 *          format="number"
 *      )
 * )
 */
class rka_barang extends Model
{
    use SoftDeletes;

    public $table = 'rka_barang';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'kode_organisasi',
        'nama_organisasi',
        'tahun_rka',
        'kode_barang',
        'nama_barang',
        'jumlah',
        'harga_satuan',
        'nilai'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kode_organisasi' => 'string',
        'nama_organisasi' => 'string',
        'tahun_rka' => 'string',
        'kode_barang' => 'string',
        'nama_barang' => 'string',
        'jumlah' => 'integer',
        'harga_satuan' => 'float',
        'nilai' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
