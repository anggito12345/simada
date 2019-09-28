<?php

namespace App\Repositories;

use App\Models\detilkonstruksi;
use App\Repositories\BaseRepository;

/**
 * Class detilkonstruksiRepository
 * @package App\Repositories
 * @version September 28, 2019, 2:10 pm UTC
*/

class detilkonstruksiRepository extends BaseRepository
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
        'tglmulai',
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
        return detilkonstruksi::class;
    }
}
