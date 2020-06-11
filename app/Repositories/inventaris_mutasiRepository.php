<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\inventaris_mutasi;
use App\Repositories\BaseRepository;
use Auth;
use c;
use Illuminate\Support\Facades\DB;

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

    public static $status = [
        'STEP-1' => 'Menunggu Persetujuan Dinas Tujuan',
        'STEP-2' => 'Menunggu Persetujuan BPKAD',
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
     * Check inventaris already on mutasi
     * @param array $inventaris
     * @return boolean
     */
    public function isExist($inventaris = []) {
        $isExist = \App\Models\inventaris_mutasi::where([
            'noreg' => $inventaris['noreg'],
            'pidbarang' => $inventaris['pidbarang'],
            'tahun_perolehan' => $inventaris['tahun_perolehan'],
            'harga_satuan' => $inventaris['harga_satuan'],
        ])->count();
        
        return $isExist > 0;
    }

    /**
     * copy invetaris to inventaris mutasi temporary 
     */

    public function moveInventaris($dataDetils = [], $idMutasi)
    {
        foreach ($dataDetils as $dataDetil) {
            // move 
            $inventariPrepareToCopy = \App\Models\inventaris::where('id', $dataDetil['inventaris'])->first()->toArray();

            // check is already on mutasi
            if ($this->isExist($inventariPrepareToCopy)) {
                throw new Exception("Inventaris telah diajukan");                
                return;
            }

            $inventariPrepareToCopy['mutasi_id'] = $idMutasi;
            $inventariPrepareToCopy['mutasi_at'] = date('Y-m-d H:i:s');
            $inventariPrepareToCopy['status'] = 'STEP-1';

            $this->create($inventariPrepareToCopy);

            \App\Models\inventaris::where('id', $dataDetil['inventaris'])->delete();
        }
    }


    /**
     * instance count inventaris mutasi in particular user
     */

    public static function countDestFirst()
    {
        return \App\Models\inventaris_mutasi::join('mutasi', 'mutasi.id', 'inventaris_mutasi.mutasi_id')
            ->where('mutasi.opd_tujuan', Auth::user()->pid_organisasi)
            ->count();
    }

    /**
     * for cancel each item of inventaris mutasi
     */

    public function cancel($req, $inventaris_historyRepository)
    {
        $isAlreadyUpload = false;
        $fileDokumens = [];

        foreach (json_decode($req->get('items'), true) as $key => $item) {
            $theItem = $this->allQuery([])->where([
                'mutasi_id' => $item['id']
            ])->get();

            if (empty($theItem)) {
                return response('No Found', 404);
            }

            foreach ($theItem as $k => $each) {

                switch ($req->get('step')) {
                  
                    case 'STEP-2': {
                            if ($each['status'] == 'STEP-2') {
                                DB::beginTransaction();
                                $fileDokumens = [];

                                try {
                                    $req->merge(['mutasi_id' => $each["mutasi_id"]]);

                                    if (!$isAlreadyUpload) {
                                        $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen_mutasi_cancel', $req, "inventaris_mutasi", function ($metadatas, $index, $systemUpload) {
                                            if (isset($metadatas['dokumen_mutasi_cancel_metadata_keterangan'][$index]) && $metadatas['dokumen_mutasi_cancel_metadata_keterangan'][$index] != null) {
                                                $systemUpload->keterangan = $metadatas['dokumen_mutasi_cancel_metadata_keterangan'][$index];
                                            }
    
                                            $systemUpload->uid = $metadatas['dokumen_mutasi_cancel_metadata_uid'][$index];
                                            $systemUpload->foreign_field = 'id';
                                            $systemUpload->jenis = 'Dokumen Pembatalan Mutasi (BPKAD)';
                                            $systemUpload->foreign_table = 'inventaris_mutasi';
                                            $systemUpload->foreign_id = $metadatas['mutasi_id'];

                                            return $systemUpload;
                                        });

                                        $isAlreadyUpload = true;
                                    }

                                    $inventaris = \App\Models\inventaris::withTrashed()->find($each['id']);

                                    if (empty($inventaris)) {
                                        return response()->json([
                                            'message' => 'Inventaris not found'
                                        ], 405);
                                    }

                                    $each->update([
                                        'status' => 'CANCELLED'
                                    ]);

                                    $inventaris->restore();

                                    $mutasi = \App\Models\mutasi::find($each['mutasi_id']);

                                    if (empty($mutasi)) {
                                        return response()->json([
                                            'message' => 'Mutasi not found'
                                        ], 405);
                                    }

                                    $mutasi->cancel_note = $req->get('cancel_note');
                                    $mutasi->status = 'CODE2';
                                    $mutasi->save();

                                    DB::commit();
                                } catch (\Exception $e) {
                                    \App\Helpers\FileHelpers::deleteAll($fileDokumens);
                                    DB::rollBack();
                                    return response()->json([
                                        'message' => $e->getMessage()
                                    ], 500);
                                }
                            }
                            break;
                        }                  
                }
            }
        }

        return response()->json([
            'message' => 'Berhasil dibatalkan'
        ], 200);
    }

    /**
     * for approvements each item of inventaris mutasis
     */

    public function approvements($req, $inventaris_historyRepository)
    {
        $isAlreadyUpload = false;
        $fileDokumens = [];

        foreach (json_decode($req->get('items'), true) as $key => $item) {
            $theItem = inventaris_mutasi::where([
                'mutasi_id' => $item['id'],
            ])->get();

            if (empty($theItem)) {
                return response('No Found', 404);
            }

            foreach ($theItem as $k => $each) {

                switch ($req->get('step')) {
                    case 'STEP-1': {
                            if ($each['status'] == 'STEP-1') {
                                $each->update([
                                    'status' => 'STEP-2'
                                ]);
                            }

                            break;
                        }
                    case 'STEP-2': {
                            if ($each['status'] == 'STEP-2') {
                                DB::beginTransaction();
                                $fileDokumens = [];
                                try {
                                    $req->merge(['mutasi_id' => $each["mutasi_id"]]);

                                    if (!$isAlreadyUpload) {
                                        $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen_persetujuan_mutasi', $req, "inventaris_mutasi", function ($metadatas, $index, $systemUpload) {
                                            if (isset($metadatas['dokumen_persetujuan_mutasi_metadata_keterangan'][$index]) && $metadatas['dokumen_persetujuan_mutasi_metadata_keterangan'][$index] != null) {
                                                $systemUpload->keterangan = $metadatas['dokumen_persetujuan_mutasi_metadata_keterangan'][$index];
                                            }
    
                                            $systemUpload->uid = $metadatas['dokumen_persetujuan_mutasi_metadata_uid'][$index];
                                            $systemUpload->foreign_field = 'id';
                                            $systemUpload->jenis = 'Dokumen Persetujuan Mutasi (BPKAD)';
                                            $systemUpload->foreign_table = 'inventaris_mutasi';
                                            $systemUpload->foreign_id = $metadatas['mutasi_id'];


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
                            }
                            break;
                        }
                    case 'STEP-3': {
                            DB::beginTransaction();
                            try {
                                $each->delete();

                                // getting information of mutasi
                                $mutasi = \App\Models\mutasi::find($each['mutasi_id']);

                                if (empty($mutasi)) {
                                    return response()->json([
                                        'message' => 'mutasi not found'
                                    ], 500);
                                }

                                $mutasi->status = 'CODE3';
                                $mutasi->save();

                                $inventaris = \App\Models\inventaris::withTrashed()->find($each['id']);


                                if (empty($inventaris)) {
                                    return response()->json([
                                        'message' => 'inventaris not found'
                                    ], 500);
                                }

                                $preForCreteKodeLokasi = $inventaris->toArray();
                                $preForCreteKodeLokasi['pid_organisasi'] = $mutasi->opd_tujuan;
                                $preForCreteKodeLokasi['pidopd'] = $mutasi->opd_tujuan;
                                $preForCreteKodeLokasi['kode_lokasi'] = \App\Repositories\inventarisRepository::generateKodeLokasi($preForCreteKodeLokasi);

                                // update inventaris ownership
                                $inventaris->pidopd = $mutasi->opd_tujuan;
                                $inventaris->pid_organisasi = $mutasi->opd_tujuan;
                                $inventaris->kode_lokasi = $preForCreteKodeLokasi['kode_lokasi'];

                                $inventaris->save();

                                $inventaris_historyRepository->postHistory($preForCreteKodeLokasi, Constant::$ACTION_HISTORY['MUT']);

                                $inventaris->restore();

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
     * count all mutasi workflow
     */

    public function count($req)
    {
        $count = [
            'step1' => 0,
            'step2' => 0,
            'step3' => 0
        ];

        $count['step1'] = count($this->allQuery([])->select([
            'inventaris_mutasi.mutasi_id'
        ])->join('mutasi', 'mutasi.id', 'inventaris_mutasi.mutasi_id')
            ->groupBy(['inventaris_mutasi.mutasi_id'])
            ->whereRaw('mutasi.draft IS NULL')
            ->where([
                'mutasi.opd_tujuan' => Auth::user()->pid_organisasi,
                'inventaris_mutasi.status' => 'STEP-1'
            ])->get());

        if (c::is([], [], [0])) {
            $count['step2'] = count($this->allQuery()->select([
                'inventaris_mutasi.mutasi_id'
            ])
                ->whereRaw('mutasi.draft IS NULL')
                ->where([
                    'mutasi.opd_tujuan' => Auth::user()->pid_organisasi,
                    'inventaris_mutasi.status' => 'STEP-2'
                ])
                ->join('mutasi', 'mutasi.id', 'inventaris_mutasi.mutasi_id')
                ->groupBy(['inventaris_mutasi.mutasi_id'])->get());
        } else {
            $count['step2'] = count($this->allQuery()->select([
                'inventaris_mutasi.mutasi_id'
            ])
                ->whereRaw('mutasi.draft IS NULL')
                ->where([
                    'inventaris_mutasi.status' => 'STEP-2'
                ])
                ->join('mutasi', 'mutasi.id', 'inventaris_mutasi.mutasi_id')
                ->groupBy(['inventaris_mutasi.mutasi_id'])->get());
        }


        $count['step3'] = count($this->allQuery([
            'mutasi.opd_tujuan' => Auth::user()->pid_organisasi,
        ])->select([
            'inventaris_mutasi.mutasi_id'
        ])->join('mutasi', 'mutasi.id', 'inventaris_mutasi.mutasi_id')
            ->groupBy(['inventaris_mutasi.mutasi_id'])
            ->whereRaw('mutasi.draft IS NULL')
            ->where([
                'mutasi.opd_tujuan' => Auth::user()->pid_organisasi,
                'inventaris_mutasi.status' => 'STEP-3'
            ])->get());

        return response()->json([
            'data' => $count
        ]);
    }
}
