<?php

namespace App\Repositories;

use App\Models\sys_workflow;
use App\Repositories\BaseRepository;

/**
 * Class sys_workflowRepository
 * @package App\Repositories
 * @version October 1, 2020, 7:47 pm UTC
*/

class sys_workflowRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'trigger',
        'pid_user',
        'do',
        'seq_order',
        'data',
        'data_do'
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
        return sys_workflow::class;
    }
}
