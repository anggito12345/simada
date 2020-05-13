<?php

namespace App\Repositories;

use App\Models\rka_barang;
use App\Repositories\BaseRepository;

/**
 * Class rka_barangRepository
 * @package App\Repositories
 * @version May 10, 2020, 6:13 am UTC
*/

class rka_barangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return rka_barang::class;
    }
}
