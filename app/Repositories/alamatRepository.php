<?php

namespace App\Repositories;

use App\Models\alamat;
use App\Repositories\BaseRepository;

/**
 * Class alamatRepository
 * @package App\Repositories
 * @version September 7, 2019, 1:37 pm UTC
*/

class alamatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pid',
        'nama',
        'jenis',
        'kodepos'
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
        return alamat::class;
    }
}
