<?php

namespace App\Repositories;

use App\Models\reklas_detil;
use App\Repositories\BaseRepository;

/**
 * Class reklas_detilRepository
 * @package App\Repositories
 * @version January 20, 2020, 9:55 am UTC
*/

class reklas_detilRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
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
        return reklas_detil::class;
    }
}
