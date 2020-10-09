<?php

namespace App\Repositories;

use App\Models\m_kode_daerah;
use App\Repositories\BaseRepository;

/**
 * Class m_kode_daerahRepository
 * @package App\Repositories
 * @version September 30, 2020, 2:49 pm UTC
*/

class m_kode_daerahRepository extends BaseRepository
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
        return m_kode_daerah::class;
    }
}
