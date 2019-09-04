<?php

namespace App\Repositories;

use App\Models\barang;
use App\Repositories\BaseRepository;

/**
 * Class barangRepository
 * @package App\Repositories
 * @version September 4, 2019, 3:42 pm UTC
*/

class barangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pid',
        'kodetampil',
        'kode_rek',
        'nama_rek_aset',
        'jenis_barang',
        'umur_ekononomis',
        'aset',
        'obyek',
        'rincianobyek',
        'subrincianobyek'
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
        return barang::class;
    }
}
