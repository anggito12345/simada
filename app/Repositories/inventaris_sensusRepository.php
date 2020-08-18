<?php

namespace App\Repositories;

use App\Models\inventaris_sensus;
use App\Repositories\BaseRepository;

/**
 * Class inventaris_sensusRepository
 * @package App\Repositories
 * @version August 13, 2020, 9:45 am UTC
*/

class inventaris_sensusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idinventaris',
        'no_sk',
        'tanggal_sk'
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
