<?php

namespace App\Repositories;

use App\Models\detilmesin;
use App\Repositories\BaseRepository;

/**
 * Class detilmesinRepository
 * @package App\Repositories
 * @version September 8, 2019, 3:02 pm UTC
*/

class detilmesinRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'pidinventaris',
        'merk',
        'ukuran',
        'bahan',
        'nopabrik',
        'norangka',
        'nomesin',
        'nopol',
        'bpkb',
        'keterangan',
        'dokumen',
        'foto'
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
        return detilmesin::class;
    }
}
