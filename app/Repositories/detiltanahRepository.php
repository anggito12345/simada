<?php

namespace App\Repositories;

use App\Models\detiltanah;
use App\Repositories\BaseRepository;

/**
 * Class detiltanahRepository
 * @package App\Repositories
 * @version September 8, 2019, 1:28 pm UTC
*/

class detiltanahRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pidinventaris',
        'luas',
        'alamat',
        'idkota',
        'idkecamatan',
        'idkelurahan',
        'koordinatlokasi',
        'koordinattanah',
        'hak',
        'status_sertifikat',
        'tgl_sertifikat',
        'nama_sertifikat',
        'penggunaan',
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
        return detiltanah::class;
    }
}
