<?php

namespace App\Repositories;

use App\Models\modules;
use App\Repositories\BaseRepository;

/**
 * Class modulesRepository
 * @package App\Repositories
 * @version November 13, 2019, 2:11 pm UTC
*/

class modulesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama'
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
        return modules::class;
    }

   
}
