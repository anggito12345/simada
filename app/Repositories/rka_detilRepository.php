<?php

namespace App\Repositories;

use App\Models\rka_detil;
use App\Repositories\BaseRepository;

/**
 * Class rka_detilRepository
 * @package App\Repositories
 * @version November 5, 2019, 1:51 pm UTC
*/

class rka_detilRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pid',
        'no_rka',
        'nilai_kontrak',
        'keterangan'
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
        return rka_detil::class;
    }
}
