<?php

namespace App\Repositories;

use App\Models\sys_workflow_master;
use App\Repositories\BaseRepository;

/**
 * Class sys_workflow_masterRepository
 * @package App\Repositories
 * @version October 1, 2020, 7:59 pm UTC
*/

class sys_workflow_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nama',
        'kondisi_1',
        'kondisi_2',
        'kondisi_3',
        'kondisi_4'
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
        return sys_workflow_master::class;
    }
}
