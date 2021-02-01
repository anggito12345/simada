<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="inventaris_penyusutan",
 *      required={"deskripsi"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="beban_penyusutan_perbulan",
 *          description="beban_penyusutan_perbulan",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="masa_manfaat_sd_akhir_tahun",
 *          description="masa_manfaat_sd_akhir_tahun",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="penyusutan_sd_tahun_sebelumnya",
 *          description="penyusutan_sd_tahun_sebelumnya",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="running_penyesutan",
 *          description="running_penyesutan",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="running_sd_bulan",
 *          description="running_sd_bulan",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="penyusutan_tahun_sekarang",
 *          description="penyusutan_tahun_sekarang",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="penyusutan_sd_tahun_sekarang",
 *          description="penyusutan_sd_tahun_sekarang",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class inventaris_penyusutan extends Model
{


    public $table = 'report_inventaris_penyusutan';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'deskripsi',
        'beban_penyusutan_perbulan',
        'masa_manfaat_sd_akhir_tahun',
        'penyusutan_sd_tahun_sebelumnya',
        'running_penyusutan',
        'running_sd_bulan',
        'penyusutan_tahun_sekarang',
        'penyusutan_sd_tahun_sekarang',
        'bulan_manfaat_berjalan',
        'nilai_buku'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'beban_penyusutan_perbulan' => 'double',
        'masa_manfaat_sd_akhir_tahun' => 'integer',
        'penyusutan_sd_tahun_sebelumnya' => 'double',
        'running_penyusutan' => 'date',
        'running_sd_bulan' => 'integer',
        'penyusutan_tahun_sekarang' => 'double',
        'penyusutan_sd_tahun_sekarang' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'deskripsi' => 'required'
    ];


}
