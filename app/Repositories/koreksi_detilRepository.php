<?php

namespace App\Repositories;

use App\Models\koreksi_detil;
use App\Repositories\BaseRepository;

/**
 * Class koreksi_detilRepository
 * @package App\Repositories
 * @version January 24, 2020, 9:27 am UTC
*/

class koreksi_detilRepository extends BaseRepository
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
        return koreksi_detil::class;
    }
}
