<?php

namespace App\Repositories;

use App\Models\pemeliharaan;
use App\Repositories\BaseRepository;

/**
 * Class pemeliharaanRepository
 * @package App\Repositories
 * @version October 2, 2019, 4:29 pm UTC
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
