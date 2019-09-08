<?php

namespace App\Repositories;

use App\Models\kondisi;
use App\Repositories\BaseRepository;

/**
 * Class kondisiRepository
 * @package App\Repositories
 * @version September 8, 2019, 1:26 am UTC
*/

class kondisiRepository extends BaseRepository
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
        return kondisi::class;
    }
}
