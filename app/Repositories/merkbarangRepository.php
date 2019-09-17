<?php

namespace App\Repositories;

use App\Models\merkbarang;
use App\Repositories\BaseRepository;

/**
 * Class merkbarangRepository
 * @package App\Repositories
 * @version September 8, 2019, 1:46 am UTC
*/

class merkbarangRepository extends BaseRepository
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
        return merkbarang::class;
    }
}
