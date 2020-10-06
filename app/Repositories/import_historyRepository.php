<?php

namespace App\Repositories;

use App\Models\import_history;
use App\Repositories\BaseRepository;

/**
 * Class import_historyRepository
 * @package App\Repositories
 * @version September 10, 2020, 9:14 am UTC
*/

class import_historyRepository extends BaseRepository
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
        return import_history::class;
    }
}
