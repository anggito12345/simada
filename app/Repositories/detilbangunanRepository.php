<?php

namespace App\Repositories;

use App\Models\detilbangunan;
use App\Repositories\BaseRepository;

/**
 * Class detilbangunanRepository
 * @package App\Repositories
 * @version September 9, 2019, 1:58 pm UTC
*/

class detilbangunanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pidinventaris',
        'konstruksi',
        'bertingkat',
        'beton',
        'luasbangunan',
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
        'dokumen',
        'keterangan',
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
        return detilbangunan::class;
    }
}
