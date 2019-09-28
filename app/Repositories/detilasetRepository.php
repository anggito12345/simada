<?php

namespace App\Repositories;

use App\Models\detilaset;
use App\Repositories\BaseRepository;

/**
 * Class detilasetRepository
 * @package App\Repositories
 * @version September 28, 2019, 1:57 pm UTC
*/

class detilasetRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return detilaset::class;
    }
}
