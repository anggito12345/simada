<?php

namespace App\Repositories;

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
     * copy invetaris to inventaris mutasi temporary 
     */

    public function moveInventaris($dataDetils = [], $idMutasi)
    {
        foreach ($dataDetils as $dataDetil) {
            // move 
            $inventariPrepareToCopy = \App\Models\inventaris::where('id', $dataDetil['inventaris'])->first()->toArray();
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
     * for approvements each item of inventaris mutasis
     */

    public function approvements($req)
    {
        $isAlreadyUpload = false;
        $fileDokumens = [];
        
        foreach (json_decode($req->get('items'), true) as $key => $item) {
            $theItem = $this->all([
                'mutasi_id' => $item['id']
            ]);

            if (empty($theItem)) {
                return response('Hello World', 200);
            }

            foreach ($theItem as $k => $each) { 

                switch($req->get('step')) {
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
                            try {
                                $req->merge(['mutasi_id' => $each["mutasi_id"]]);            
                        
                                if (!$isAlreadyUpload) {
                                    $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $req, "inventaris_mutasi", function($metadatas, $index, $systemUpload) {
                                            
                                        $systemUpload->foreign_field = 'id';
                                        $systemUpload->jenis = 'bpkad';
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

                            $inventaris = \App\Models\inventaris::withTrashed()->find($each['id']);


                            if (empty($inventaris)) {
                                return response()->json([
                                    'message' => 'inventaris not found'
                                ], 500);
                            }                            

                            $preForCreteKodeLokasi = $inventaris->toArray();
                            $preForCreteKodeLokasi['pid_organisasi'] = $mutasi->opd_tujuan;
                            $preForCreteKodeLokasi['pidopd'] = $mutasi->opd_tujuan;

                            $inventaris->update([
                                'pid_organisasi' => $mutasi->opd_tujuan,
                                'pidopd' => $mutasi->opd_tujuan,
                                'kode_lokasi' => \App\Repositories\inventarisRepository::generateKodeLokasi($preForCreteKodeLokasi)
                            ]);

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

     public function count($req) {
        $count = [
            'step1'=> 0,
            'step2'=> 0,
            'step3' => 0
        ];
        
        $count['step1'] = count($this->allQuery([
            'mutasi.opd_tujuan' => Auth::user()->pid_organisasi,
        ])->select([
            'inventaris_mutasi.mutasi_id'
        ])->join('mutasi', 'mutasi.id', 'inventaris_mutasi.mutasi_id')
        ->groupBy(['inventaris_mutasi.mutasi_id'])
        ->where([
            'inventaris_mutasi.status' => 'STEP-1'
        ])->get());

        $count['step2'] = count($this->allQuery()->select([
            'inventaris_mutasi.mutasi_id'
        ])
        ->where([
            'inventaris_mutasi.status' => 'STEP-2'
        ])
        ->join('mutasi', 'mutasi.id', 'inventaris_mutasi.mutasi_id')
        ->groupBy(['inventaris_mutasi.mutasi_id'])->get());

        $count['step3'] = count($this->allQuery([
            'mutasi.opd_tujuan' => Auth::user()->pid_organisasi,
        ])->select([
            'inventaris_mutasi.mutasi_id'
        ])->join('mutasi', 'mutasi.id', 'inventaris_mutasi.mutasi_id')
        ->groupBy(['inventaris_mutasi.mutasi_id'])
        ->where([
            'inventaris_mutasi.status' => 'STEP-3'
        ])->get());

        return response()->json([
            'data' => $count
        ]);
     }
}
