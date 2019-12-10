<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\inventaris;
use App\Models\inventaris_penghapusan;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Trend\Trend;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        'STEP-2' => 'Konfimasi Pemohon',
        'STEP-3' => 'Validasi BPKAD',
        'STEP-4' => 'Selesai',
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
    public function approvements($req, $inventaris_historyRepository)
    {
        $isAlreadyUpload = true;

        foreach (json_decode($req->get('items'), true) as $key => $item) {
            $fileDokumens = [];
            $theItem = $this->all([
                'pid_penghapusan' => $item['id']
            ]);

            if (empty($theItem)) {
                return response('No Found', 404);
            }

            foreach ($theItem as $k => $each) {
                switch ($req->get('step')) {
                    case 'STEP-1': {
                            if ($each['status'] != 'STEP-1') {
                                continue;
                            }


                            DB::beginTransaction();
                            try {
                                $req->merge(['pid_penghapusan' => $each["pid_penghapusan"]]);

                                if (!$isAlreadyUpload) {
                                    $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $req, "inventaris_penghapusan", function ($metadatas, $index, $systemUpload) {

                                        $systemUpload->foreign_field = 'id';
                                        $systemUpload->jenis = 'penghapusan-step1';
                                        $systemUpload->foreign_table = 'inventaris_penghapusan';
                                        $systemUpload->foreign_id = $metadatas['pid_penghapusan'];


                                        return $systemUpload;
                                    });

                                    $isAlreadyUpload = true;
                                }

                                $penghapusan = \App\Models\penghapusan::find($each['pid_penghapusan']);


                                if (empty($penghapusan)) {
                                    throw new NotFoundHttpException("Data tidak ditemukan");
                                }

                                $penghapusan->nomor_surat_persetujuan_bpkad = $req->get('nomor_surat');
                                $penghapusan->save();


                                $each->update([
                                    'status' => 'STEP-2'
                                ]);

                                DB::commit();
                            } catch (\Exception $e) {
                                \App\Helpers\FileHelpers::deleteAll($fileDokumens);
                                DB::rollBack();
                                return response()->json([
                                    'message' => $e->getMessage()
                                ], 500);
                            }
                            break;
                        }
                    case 'STEP-2': {
                            if ($each['status'] != 'STEP-2') {
                                continue;
                            }
                            DB::beginTransaction();
                            try {
                                $req->merge(['pid_penghapusan' => $each["pid_penghapusan"]]);

                                if (!$isAlreadyUpload) {
                                    $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $req, "inventaris_penghapusan", function ($metadatas, $index, $systemUpload) {

                                        $systemUpload->foreign_field = 'id';
                                        $systemUpload->jenis = 'penghapusan-step2';
                                        $systemUpload->foreign_table = 'inventaris_penghapusan';
                                        $systemUpload->foreign_id = $metadatas['pid_penghapusan'];


                                        return $systemUpload;
                                    });

                                    $isAlreadyUpload = true;
                                }


                                $each->update([
                                    'status' => 'STEP-3'
                                ]);

                                DB::commit();
                            } catch (\Exception $e) {
                                \App\Helpers\FileHelpers::deleteAll($fileDokumens);
                                DB::rollBack();
                                return response()->json([
                                    'message' => $e->getMessage()
                                ], 500);
                            }
                            break;
                        }
                    case 'STEP-3': {
                            if ($each['status'] != 'STEP-3') {
                                continue;
                            }

                            DB::beginTransaction();
                            try {

                                $each->update([
                                    'status' => 'STEP-4'
                                ]);

                                $newInventaris = inventaris::find($each['id'])->toArray();                            

                                $inventaris_historyRepository->postHistory($newInventaris, Constant::$ACTION_HISTORY['PENGHAPUSAN']);

                                \App\Models\inventaris::withTrashed()->find($each['id'])->delete();

                                DB::commit();
                            } catch (\Exception $e) { 

                                DB::rollBack();
                                return response()->json([
                                    'message' => $e->getMessage()
                                ], 500);
                            }


                            break;
                        }
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
            'step2' => 0,
            'step3' => 0
        ];

        $count['step1'] = count($this->allQuery()->select([
            'inventaris_penghapusan.pid_penghapusan'
        ])
            ->where([
                'inventaris_penghapusan.status' => 'STEP-1'
            ])
            ->join('penghapusan', 'penghapusan.id', 'inventaris_penghapusan.pid_penghapusan')
            ->join('users', 'users.id', 'penghapusan.created_by')
            ->groupBy(['inventaris_penghapusan.pid_penghapusan'])->get());

        $count['step2'] = count($this->allQuery()->select([
            'inventaris_penghapusan.pid_penghapusan'
        ])
            ->where([
                'users.pid_organisasi' => Auth::user()->pid_organisasi,
                'inventaris_penghapusan.status' => 'STEP-2'
            ])
            ->join('penghapusan', 'penghapusan.id', 'inventaris_penghapusan.pid_penghapusan')
            ->join('users', 'users.id', 'penghapusan.created_by')
            ->groupBy(['inventaris_penghapusan.pid_penghapusan'])->get());

        $count['step3'] = count($this->allQuery()->select([
            'inventaris_penghapusan.pid_penghapusan'
        ])
            ->where([
                'inventaris_penghapusan.status' => 'STEP-3'
            ])
            ->join('penghapusan', 'penghapusan.id', 'inventaris_penghapusan.pid_penghapusan')
            ->join('users', 'users.id', 'penghapusan.created_by')
            ->groupBy(['inventaris_penghapusan.pid_penghapusan'])->get());
        return response()->json([
            'data' => $count
        ]);
    }
}
