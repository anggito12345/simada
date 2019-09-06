<?php

namespace App\Repositories;

use App\Models\penghapusan;
use App\Repositories\BaseRepository;

/**
 * Class penghapusanRepository
 * @package App\Repositories
 * @version September 6, 2019, 1:21 pm UTC
*/

class penghapusanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pidinventaris',
        'noreg',
        'tglhapus',
        'kriteria',
        'kondisi',
        'harga_apprisal',
        'dokumen',
        'foto',
        'nosk',
        'tglsk',
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
        return penghapusan::class;
    }
}
