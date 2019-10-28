<?php

namespace App\Repositories;

use App\Models\mutasi;
use App\Repositories\BaseRepository;

/**
 * Class mutasiRepository
 * @package App\Repositories
 * @version October 28, 2019, 3:42 pm UTC
*/

class mutasiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'opd_asal',
        'opd_tujuan',
        'no_bast',
        'tgl_bast',
        'idpegawai',
        'alasan_mutasi',
        'keterangan'
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
        return mutasi::class;
    }
}
