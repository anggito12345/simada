<?php

namespace App\Repositories;

use App\Models\inventaris_history;
use App\Repositories\BaseRepository;

/**
 * Class inventaris_historyRepository
 * @package App\Repositories
 * @version December 3, 2019, 2:14 pm UTC
*/

class inventaris_historyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'noreg',
        'pidbarang',
        'pidopd',
        'pidlokasi',
        'tgl_sensus',
        'volume',
        'pembagi',
        'harga_satuan',
        'perolehan',
        'kondisi',
        'lokasi_detil',
        'keterangan',
        'tahun_perolehan',
        'jumlah',
        'tgl_dibukukan',
        'satuan',
        'draft',
        'pidopd_cabang',
        'pidupt',
        'kode_lokasi',
        'alamat_propinsi',
        'alamat_kota',
        'idpegawai',
        'pid_organisasi',
        'kode_gedung',
        'kode_ruang',
        'penanggung_jawab',
        'umur_ekonomis',
        'action',
        'history_at'
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
        return inventaris_history::class;
    }

    /**
     * new history based on inventaris values
     */
    public function postHistory($inventaris, $action) {
        $inventaris['history_at'] = date('Y-m-d H:i:s');
        $inventaris['action'] = $action['nama'];
        $inventaris['harga_satuan'] = (int)$inventaris['harga_satuan'];
        $this->create($inventaris);
    }

}
