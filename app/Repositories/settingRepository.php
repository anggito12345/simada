<?php

namespace App\Repositories;

use App\Models\setting;
use App\Repositories\BaseRepository;

/**
 * Class settingRepository
 * @package App\Repositories
 * @version October 20, 2019, 12:11 pm UTC
*/

class settingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'nilai',
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
        return setting::class;
    }
}
