<?php

namespace App\Repositories;

use App\Models\inventaris;
use App\Repositories\BaseRepository;

/**
 * Class inventarisRepository
 * @package App\Repositories
 * @version September 5, 2019, 2:24 pm UTC
*/

class inventarisRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'noreg',
        'pidbarang',
        'pidopd',
        'pidlokasi',
        'tgl_perolehan',
        'tgl_sensus',
        'volume',
        'pembagi',
        'satuan',
        'harga_satuan',
        'perolehan',
        'kondisi',
        'lokasi_detil',
        'umur_ekonomis',
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
        return inventaris::class;
    }
}
