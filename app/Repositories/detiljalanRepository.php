<?php

namespace App\Repositories;

use App\Models\detiljalan;
use App\Repositories\BaseRepository;

/**
 * Class detiljalanRepository
 * @package App\Repositories
 * @version September 9, 2019, 3:32 pm UTC
*/

class detiljalanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pidinventaris',
        'konstruksi',
        'panjang',
        'lebar',
        'luas',
        'alamat',
        'idkota',
        'idkecamatan',
        'idkelurahan',
        'koordinatlokasi',
        'koordinattanah',
        'tgldokumen',
        'nodokumen',
        'luastanah',
        'statustanah',
        'kodetanah',
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
        return detiljalan::class;
    }
}
