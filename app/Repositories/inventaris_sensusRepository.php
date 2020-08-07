<?php

namespace App\Repositories;

use App\Models\inventaris_sensus;
use App\Repositories\BaseRepository;

/**
 * Class inventaris_sensusRepository
 * @package App\Repositories
 * @version August 7, 2020, 10:09 am UTC
*/

class inventaris_sensusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idinventaris',
        'kondisi'
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
        return inventaris_sensus::class;
    }
}
