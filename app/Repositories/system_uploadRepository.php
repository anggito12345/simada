<?php

namespace App\Repositories;

use App\Models\system_upload;
use App\Repositories\BaseRepository;

/**
 * Class system_uploadRepository
 * @package App\Repositories
 * @version September 18, 2019, 4:57 pm UTC
*/

class system_uploadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uid',
        'name',
        'type',
        'size',
        'path'
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
        return system_upload::class;
    }
}
