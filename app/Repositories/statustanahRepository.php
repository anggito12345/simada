<?php

namespace App\Repositories;

use App\Models\statustanah;
use App\Repositories\BaseRepository;

/**
 * Class statustanahRepository
 * @package App\Repositories
 * @version September 9, 2019, 2:14 pm UTC
*/

class statustanahRepository extends BaseRepository
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
        return statustanah::class;
    }
}
