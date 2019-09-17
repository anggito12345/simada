<?php

namespace App\Repositories;

use App\Models\jenisbarang;
use App\Repositories\BaseRepository;

/**
 * Class jenisbarangRepository
 * @package App\Repositories
 * @version September 7, 2019, 1:53 pm UTC
*/

class jenisbarangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return jenisbarang::class;
    }
}
