<?php

namespace App\Repositories;

use App\Models\koreksi;
use App\Repositories\BaseRepository;

/**
 * Class koreksiRepository
 * @package App\Repositories
 * @version January 24, 2020, 9:13 am UTC
*/

class koreksiRepository extends BaseRepository
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
        return koreksi::class;
    }
}
