<?php

namespace App\Repositories;

use App\Models\inventaris_mutasi;
use App\Repositories\BaseRepository;
use Auth;

/**
 * Class inventaris_mutasiRepository
 * @package App\Repositories
 * @version November 18, 2019, 3:45 pm UTC
*/

class inventaris_mutasiRepository extends BaseRepository
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
        'umur_ekonomis',
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
        'mutasi_at',
        'status'
    ];

    protected $status = [
        0 => 'Menunggu Persetujuan Dinas Tujuan'
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
        return inventaris_mutasi::class;
    }

    /**
     * copy invetaris to inventaris mutasi temporary 
     */

    public function moveInventaris($dataDetils = [], $idMutasi) {
        foreach ($dataDetils as $dataDetil) {
            // move 
            $inventariPrepareToCopy = \App\Models\inventaris::where('id', $dataDetil['inventaris'])->first()->toArray();
            $inventariPrepareToCopy['mutasi_id'] = $idMutasi;
            $inventariPrepareToCopy['mutasi_at'] = date('Y-m-d H:i:s');
            $inventariPrepareToCopy['status'] = $this->status[0];

            $this->create($inventariPrepareToCopy);

            \App\Models\inventaris::where('id', $dataDetil['inventaris'])->delete();
        }
     }


     /**
      * instance count inventaris mutasi in particular user
      */

      public static function countDestFirst() {
          return \App\Models\inventaris_mutasi::
            join('mutasi','mutasi.id', 'inventaris_mutasi.mutasi_id')
            ->where('mutasi.opd_tujuan', Auth::user()->pid_organisasi)
            ->count();
      }
}
