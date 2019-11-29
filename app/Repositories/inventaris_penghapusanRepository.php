<?php

namespace App\Repositories;

use App\Models\inventaris;
use App\Models\inventaris_penghapusan;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Trend\Trend;

/**
 * Class inventaris_penghapusanRepository
 * @package App\Repositories
 * @version November 19, 2019, 2:50 pm UTC
 */

class inventaris_penghapusanRepository extends BaseRepository
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
        'pid_penghapusan'
    ];

    public static $status = [
        'STEP-1' => 'Menunggu Persetujuan BPKAD',
        'STEP-2' => 'Selesai',
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
        return inventaris_penghapusan::class;
    }

    /**
     * copy invetaris to inventaris mutasi temporary 
     */

    public function moveInventaris($dataDetils = [], $id)
    {
        foreach ($dataDetils as $dataDetil) {
            // move 
            $inventariPrepareToCopy = \App\Models\inventaris::where('id', $dataDetil['inventaris'])->first()->toArray();
            $inventariPrepareToCopy['pid_penghapusan'] = $id;
            $inventariPrepareToCopy['status'] = 'STEP-1';

            $this->create($inventariPrepareToCopy);

            // \App\Models\inventaris::where('id', $dataDetil['inventaris'])->delete();
        }
    }

    /**
     * approving data penghapusan for bpkad
     */
    public function approvements($req)
    {
        $isAlreadyUpload = true;

        foreach (json_decode($req->get('items'), true) as $key => $item) {
            $theItem = $this->all([
                'pid_penghapusan' => $item['id']
            ]);

            if (empty($theItem)) {
                return response('No Found', 404);
            }

            foreach ($theItem as $k => $each) {
                DB::beginTransaction();
                try {
                    $req->merge(['pid_penghapusan' => $each["pid_penghapusan"]]);

                    if (!$isAlreadyUpload) {
                        $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $req, "inventaris_penghapusan", function ($metadatas, $index, $systemUpload) {

                            $systemUpload->foreign_field = 'id';
                            $systemUpload->jenis = 'bpkad';
                            $systemUpload->foreign_table = 'inventaris_penghapusan';
                            $systemUpload->foreign_id = $metadatas['pid_penghapusan'];


                            return $systemUpload;
                        });

                        $isAlreadyUpload = true;
                    }


                    $each->update([
                        'status' => 'STEP-2'
                    ]);

                    inventaris::withTrashed()->find($each['id'])->delete();

                    DB::commit();
                } catch (\Exception $e) {
                    \App\Helpers\FileHelpers::deleteAll($fileDokumens);
                    DB::rollBack();
                    return response()->json([
                        'message' => $e->getMessage()
                    ], 500);
                }
            }
        }

        return response()->json([
            'message' => 'Berhasil disetujui'
        ], 200);
    }

    /**
     * count data penghapusan for dashboard
     */

    public function count($req)
    {
        $count = [
            'step1' => 0,
        ];

        $count['step1'] = count($this->allQuery()->select([
            'inventaris_penghapusan.pid_penghapusan'
        ])
        ->where([
            'inventaris_penghapusan.status' => 'STEP-1'
        ])
            ->join('penghapusan', 'penghapusan.id', 'inventaris_penghapusan.pid_penghapusan')
            ->groupBy(['inventaris_penghapusan.pid_penghapusan'])->get());

        return response()->json([
            'data' => $count
        ]);
    }
}
