<?php

namespace App\Repositories;

use App\Models\satuan_barang;
use App\Repositories\BaseRepository;

/**
 * Class satuan_barangRepository
 * @package App\Repositories
 * @version September 4, 2019, 4:35 pm UTC
*/

class satuan_barangRepository extends BaseRepository
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
        return satuan_barang::class;
    }
}
