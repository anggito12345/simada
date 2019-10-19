<?php

namespace App\Repositories;

use App\Models\jabatan;
use App\Repositories\BaseRepository;

/**
 * Class jabatanRepository
 * @package App\Repositories
 * @version October 19, 2019, 2:50 pm UTC
*/

class jabatanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'jenis'
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
        return jabatan::class;
    }
}
