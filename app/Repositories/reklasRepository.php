<?php

namespace App\Repositories;

use App\Models\reklas;
use App\Repositories\BaseRepository;

/**
 * Class reklasRepository
 * @package App\Repositories
 * @version January 20, 2020, 9:26 am UTC
*/

class reklasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'as'
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
        return reklas::class;
    }
}
