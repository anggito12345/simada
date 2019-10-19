<?php

namespace App\Repositories;

use App\Models\mitra;
use App\Repositories\BaseRepository;

/**
 * Class mitraRepository
 * @package App\Repositories
 * @version October 18, 2019, 11:44 pm UTC
*/

class mitraRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'npwp',
        'siup_tdp',
        'nama',
        'alamat',
        'telp',
        'email',
        'jenis_usaha',
        'pic',
        'jabatan_pic',
        'hp_pic',
        'email_pic',
        'aktf'
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
        return mitra::class;
    }
}
