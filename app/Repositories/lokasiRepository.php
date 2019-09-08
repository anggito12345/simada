<?php

namespace App\Repositories;

use App\Models\lokasi;
use App\Repositories\BaseRepository;

/**
 * Class lokasiRepository
 * @package App\Repositories
 * @version September 8, 2019, 1:40 am UTC
*/

class lokasiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pid',
        'nama',
        'aktif'
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
        return lokasi::class;
    }
}
