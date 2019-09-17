<?php

namespace App\Repositories;

use App\Models\organisasi;
use App\Repositories\BaseRepository;

/**
 * Class organisasiRepository
 * @package App\Repositories
 * @version September 8, 2019, 2:00 am UTC
*/

class organisasiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pid',
        'nama',
        'jenis',
        'alamat',
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
        return organisasi::class;
    }
}
