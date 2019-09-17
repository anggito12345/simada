<?php

namespace App\Repositories;

use App\Models\jenisopd;
use App\Repositories\BaseRepository;

/**
 * Class jenisopdRepository
 * @package App\Repositories
 * @version September 8, 2019, 1:19 pm UTC
*/

class jenisopdRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'aktif'
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
        return jenisopd::class;
    }
}
