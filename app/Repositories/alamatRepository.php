<?php

namespace App\Repositories;

use App\Models\alamat;
use App\Repositories\BaseRepository;

/**
 * Class alamatRepository
 * @package App\Repositories
 * @version September 7, 2019, 1:37 pm UTC
*/

class alamatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pid',
        'nama',
        'm_alamat.jenis',
        'kodepos'
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
        return alamat::class;
    }

    /**
     * get list of alamat
     */
    public function getAlamats($jenis = "") {
        $search = [];
        if ($jenis != "") {
            array_push($search, [
                'm_alamat.jenis' => $jenis
            ]);
        }
        $q = $this->allQuery($search, null, null);
        $q = $q->select([
            "m_alamat.*",
            "m_alamat_2.nama as nama_foreign"
        ]);
        $q->leftJoin("m_alamat as m_alamat_2", "m_alamat_2.id", "m_alamat.pid");
        return $q;
    }
}
