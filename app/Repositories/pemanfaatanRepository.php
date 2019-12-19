<?php

namespace App\Repositories;

use App\Models\pemanfaatan;
use App\Repositories\BaseRepository;

/**
 * Class pemanfaatanRepository
 * @package App\Repositories
 * @version October 15, 2019, 1:14 pm UTC
*/

class pemanfaatanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pidinventaris',
        'peruntukan',
        'umur',
        'umur_satuan',
        'no_perjanjian',
        'tgl_mulai',
        'tgl_akhir',
        'mitra',
        'tipe_kontribusi',
        'jumlah_kontribusi',
        'pegawai',
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
        return pemanfaatan::class;
    }
}
