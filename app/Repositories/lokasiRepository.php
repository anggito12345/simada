<?php

namespace App\Repositories;

use App\Models\lokasi;
use App\Repositories\BaseRepository;

/**
 * Class lokasiRepository
 * @package App\Repositories
 * @version September 4, 2019, 4:14 pm UTC
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
