<?php

namespace App\Repositories;

use App\Models\role;
use App\Repositories\BaseRepository;

/**
 * Class roleRepository
 * @package App\Repositories
 * @version October 8, 2019, 4:07 pm UTC
*/

class roleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'level'
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
        return role::class;
    }
}
