<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class detilaset
 * @package App\Models
 * @version September 28, 2019, 1:57 pm UTC
 *
 * @property integer pidinventaris
 * @property string buku_judul
 * @property string buku_spesifikasi
 * @property string seni_asal
 * @property string seni_pencipta
 * @property string seni_bahan
 * @property string ternak_jenis
 * @property string ternak_ukuran
 * @property string keterangan
 * @property string dokumen
 * @property string foto
 */
class detilaset extends Model
{

    public $table = 'detil_aset_lainnya';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pidinventaris',
        'buku_judul',
        'buku_spesifikasi',
        'seni_asal',
        'seni_pencipta',
        'seni_bahan',
        'ternak_jenis',
        'ternak_ukuran',
        'keterangan',
        'dokumen',
        'foto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pidinventaris' => 'integer',
        'buku_judul' => 'string',
        'buku_spesifikasi' => 'string',
        'seni_asal' => 'string',
        'seni_pencipta' => 'string',
        'seni_bahan' => 'string',
        'ternak_jenis' => 'string',
        'ternak_ukuran' => 'string',
        'keterangan' => 'string',
        'dokumen' => 'string',
        'foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
