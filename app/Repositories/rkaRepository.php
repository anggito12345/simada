<?php

namespace App\Repositories;

use App\Models\rka;
use App\Repositories\BaseRepository;

/**
 * Class rkaRepository
 * @package App\Repositories
 * @version November 5, 2019, 1:50 pm UTC
*/

class rkaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'no_spk',
        'no_bast'
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
        return rka::class;
    }
}
