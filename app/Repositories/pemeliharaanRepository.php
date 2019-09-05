<?php

namespace App\Repositories;

use App\Models\pemeliharaan;
use App\Repositories\BaseRepository;

/**
 * Class pemeliharaanRepository
 * @package App\Repositories
 * @version September 5, 2019, 2:21 pm UTC
*/

class pemeliharaanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pidinventaris',
        'tgl',
        'uraian',
        'persh',
        'alamat',
        'nokontrak',
        'tglkontrak',
        'biaya',
        'menambah',
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
        return pemeliharaan::class;
    }
}
