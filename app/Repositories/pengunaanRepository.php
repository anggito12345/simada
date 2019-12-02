<?php

namespace App\Repositories;

use App\Models\pengunaan;
use App\Repositories\BaseRepository;

/**
 * Class pengunaanRepository
 * @package App\Repositories
 * @version December 1, 2019, 6:11 am UTC
*/

class pengunaanRepository extends BaseRepository
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
        return pengunaan::class;
    }
}
