<?php

namespace App\Repositories;

use App\Models\satuanbarang;
use App\Repositories\BaseRepository;

/**
 * Class satuanbarangRepository
 * @package App\Repositories
 * @version September 8, 2019, 1:05 pm UTC
*/

class satuanbarangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'aktif',
        'bisadibagi'
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
        return satuanbarang::class;
    }
}
