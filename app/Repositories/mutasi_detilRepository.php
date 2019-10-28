<?php

namespace App\Repositories;

use App\Models\mutasi_detil;
use App\Repositories\BaseRepository;

/**
 * Class mutasi_detilRepository
 * @package App\Repositories
 * @version October 28, 2019, 3:43 pm UTC
*/

class mutasi_detilRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pid',
        'inventaris',
        'keterangan'
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
        return mutasi_detil::class;
    }
}
