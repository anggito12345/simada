<?php

namespace App\Repositories;

use App\Helpers\Access;
use App\Models\inventaris;
use App\Models\inventaris_sensus;
use App\Models\pemeliharaan;
use App\Models\ubah_satuan_stagging;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Constant;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class inventaris_sensusRepository
 * @package App\Repositories
 * @version August 13, 2020, 9:45 am UTC
*/

class inventaris_sensusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idinventaris',
        'no_sk',
        'tanggal_sk'
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
        return inventaris_sensus::class;
    }

    public static function statusSensus($sensus, $output = 'text') {
        if ($sensus == null) {
            if ($output == 'text') {
                return 'Belum disensus';
            } else {
                return '<i class=\'fa fa-close text-red\'></i>';
            }
        } else {
            switch($sensus->status_approval) {
                case 'STEP-1': {
                    if ($output == 'text') {
                        return 'Proses Verifikasi';
                    } else {
                        return '<i class=\'fa fa-info text-blue\'></i>';
                    }
                }
                case'STEP-2': {

                    if ($output == 'text') {
                        return 'Telah disensus';
                    } else {
                        return '<i class=\'fa fa-check-circle text-green\'></i>';
                    }
                    break;
                }
                default: {
                    if ($output == 'text') {
                        return 'Belum disensus';
                    } else {
                        return '<i class=\'fa fa-close text-red\'></i>';
                    }
                }

            }
        }
    }

    /**
     * approvement main logic sensus
     */

      /**
     * approving data penghapusan for bpkad
     */
    public function approvements($req, $inventaris_historyRepository, $inventarisRepository)
    {
        $isAlreadyUpload = false;

        foreach (json_decode($req->get('items'), true) as $key => $item) {
            $fileDokumens = [];
            $theItem = $this->find([
                $item['id']
            ]);


            if (empty($theItem)) {
                return response('Not Found', 404);
            }

            foreach ($theItem as $k => $each) {
                $isAlreadyUpload = false;

                switch ($req->get('step')) {
                    case 'STEP-1': {
                            if ($each['status_approval'] != 'STEP-1') {

                                break;
                            }

                            if (!Access::is([],[],[Constant::$GROUP_BPKAD_ORG])) {
                                throw Exception('Not Allowed');
                                return;
                            }


                            DB::beginTransaction();
                            try {
                                $req->merge(['id_sensus' => $each->idinventaris]);

                                if (!$isAlreadyUpload) {
                                    $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen_sensus', $req, "inventaris_sensus", function ($metadatas, $index, $systemUpload) {
                                        if (isset($metadatas['dokumen_sensus_metadata_keterangan'][$index]) && $metadatas['dokumen_sensus_metadata_keterangan'][$index] != null) {
                                            $systemUpload->keterangan = $metadatas['dokumen_sensus_metadata_keterangan'][$index];
                                        }

                                        $systemUpload->uid = $metadatas['dokumen_sensus_metadata_keterangan'][$index];
                                        $systemUpload->foreign_field = 'idinventaris';
                                        $systemUpload->jenis = 'sensus-step1';
                                        $systemUpload->foreign_table = 'inventaris_sensus';
                                        $systemUpload->foreign_id = $metadatas['idinventaris'];


                                        return $systemUpload;
                                    });

                                    $isAlreadyUpload = true;
                                }

                                // it mean all tidak ada status will remove the inventaris from db
                                if($each->status_barang == '0') {
                                    $inv = inventaris::where([
                                        'id' => $each->idinventaris
                                    ])->first();

                                    if ($each->status_barang_hilang == '1' || $each->status_barang_hilang == '2') {
                                        if (!empty($inv)) {
                                            //check if inventaris kode tujuan dan harga satuan already existing
                                            $invExisting = inventaris::where([
                                                'pidbarang' => $each->kode_tujuan,
                                                'harga_satuan' => $each->harga_satuan
                                            ])->first();
                                            if (!empty($invExisting)) {
                                                $no_reg = (int)$invExisting->no_reg;
                                                $inv->no_reg = sprintf('%03d',$no_reg + 1);
                                            }
                                            $inv->pidbarang = $each->kode_tujuan;
                                            $inv->save();
                                        }

                                    } else {
                                        if (!empty($inv)) {
                                            inventaris::where([
                                                'id' => $each->idinventaris
                                            ])->delete();
                                        }
                                    }
                                    $inventaris_historyRepository->postHistory($inv->toArray(), [
                                        'nama' => 'SENSUS TIDAK ADA ('.Constant::$SENSUS_STATUS_03[$each->status_barang_hilang].')'
                                    ]);
                                }

                                // when status barang is 1
                                else if($each->status_barang == '1') {
                                    $inv = inventaris::where([
                                        'id' => $each->idinventaris
                                    ]);

                                    // when status ubah satuan is pisah
                                    if ($each->status_ubah_satuan == '0') {

                                        inventaris::where([
                                            'id' => $each->idinventaris
                                        ])->delete();

                                        //get the stagging!
                                        $ubhStaggings = ubah_satuan_stagging::where([
                                            'id_sensus' => $each->id
                                        ])->get();

                                        for ($i=0; $i < count($ubhStaggings); $i++) {
                                            $ubhStagging = $ubhStaggings[$i];
                                            //get the inventaris
                                            $inv = inventaris::find($ubhStagging->idinventaris);
                                            $inv->id_sensus = $each->id;
                                            $inv->save();
                                        }

                                        ubah_satuan_stagging::where([
                                            'id_sensus' => $each->id
                                        ])->delete();
                                    } else {
                                        $pemeliharaan = pemeliharaan::where([
                                            'id_sensus' => $each->id
                                        ])->first();
                                        // gabung


                                        if(!empty($pemeliharaan)) {
                                            //get pemeliharaan information
                                            $inventarisPemeliharaan = inventaris::find($pemeliharaan->pidinventaris);

                                            if (!empty($inventarisPemeliharaan)) {
                                                $inventarisPemeliharaan->umur_ekonomis = (double) $inventarisPemeliharaan->umur_ekonomis + (double) $pemeliharaan->umur_ekonomis;
                                                $inventarisPemeliharaan->harga_satuan = (double) $inventarisPemeliharaan->harga_satuan + (double) $pemeliharaan->biaya;
                                                $inventarisPemeliharaan->save();
                                            }

                                            $pemeliharaan->id_sensus = null;
                                            $pemeliharaan->save();

                                        }


                                        inventaris::where([
                                            'id' => $each->idinventaris
                                        ])->delete();
                                    }

                                    // $inv = inventaris::where([
                                    //     'id_sensus' => $each->id
                                    // ]);

                                    // $inventaris_historyRepository->postHistory($inv->toArray(), [
                                    //     'nama' => 'SENSUS UBAH SATUAN ('.Constant::$SENSUS_STATUS_02[$each->status_ubah_satuan].')'
                                    // ]);
                                    // otherwise will redirect to pemeliharaan
                                }

                                else if($each->status_barang == '3') {
                                    // when status tidak tercatat
                                    $inv = inventaris::WithSensus()->where([
                                        'id_sensus' => $each->id
                                    ])->first();
                                    $inv->save();
                                    $inventaris_historyRepository->postHistory($inv->toArray(), [
                                        'nama' => 'SENSUS TIDAK TERCATAT'
                                    ]);
                                }

                                else if ($each->status_barang == '4') {
                                    // when status tercatat
                                    $data = json_decode($each->data_temporary,true);

                                    if ($data != null) {
                                        $inventarisRepository->update($data, $each->idinventaris);
                                    }

                                    $inv = inventaris::WithSensus()->where([
                                        'id' => $each->idinventaris
                                    ])->first();

                                    $inventaris_historyRepository->postHistory($inv->toArray(), [
                                        'nama' => 'SENSUS TERCATAT'
                                    ]);
                                }


                                $each->update([
                                    'status_approval' => 'STEP-2'
                                ]);



                                DB::commit();
                            } catch (\Exception $e) {
                                \App\Helpers\FileHelpers::deleteAll($fileDokumens);
                                DB::rollBack();
                                return response($e);
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
     * retrieve default sensus query
     */
    public static function query($q) {
        $q = $q->select([
            DB::raw('COALESCE(m_barang.nama_rek_aset, barang2.nama_rek_aset) as nama'),
            'inventaris_sensus.id as id',
            'inventaris_sensus.no_sk as no_sk',
            'inventaris_sensus.*',
            'inventaris_sensus.idinventaris as pidinventaris',
            DB::raw('COALESCE(inventaris.kode_barang, inven2.kode_barang ) as kode_barang'),
            'inventaris.noreg as noreg',
            'inventaris_sensus.tanggal_sk as tanggal_sk',
            'inventaris_sensus.status_barang_hilang as status_barang_hilang',
            'inventaris_sensus.status_barang as status_barang',
            "m_jenis_barang.kelompok_kib",
            'm_organisasi.nama as pemohon',

        ])
        ->from('inventaris_sensus')
        ->leftJoin('inventaris','inventaris.id','inventaris_sensus.idinventaris')
        ->leftJoin('m_barang', 'm_barang.id', 'inventaris.pidbarang')
        ->leftJoin('inventaris as inven2','inven2.id_sensus','inventaris_sensus.id')
        ->leftJoin('m_barang as barang2', 'barang2.id', 'inven2.pidbarang')
        ->leftJoin("m_jenis_barang", "m_jenis_barang.kode", "m_barang.kode_jenis")
        ->leftJoin('users', 'users.id', 'inventaris_sensus.created_by')
        ->leftJoin('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi');

        if (!Access::is([],[], [Constant::$GROUP_BPKAD_ORG])) {
            $q = $q->where('users.pid_organisasi', Auth::user()->pid_organisasi);
        }

        return $q;
    }

    /**
     * to put data from constant class into fetched data
     *
     * $param data: fetched from query method
     *
     * return array map same as param but with additional column in it
     */
    public function initialStaticData($dataSensus = []) {
        $ret = [];
        foreach($dataSensus as $value)  {
            $value['status_barang_'] = Constant::$SENSUS_STATUS_01[$value['status_barang']];

            $ret = array_push($ret, $value);
        }

        return $ret;
    }

    public function insertLogic(Request $request) {
        $input = $request->all();

        if ($input['idinventaris'] == 'null') {
            $input['idinventaris'] = null;
        }

        $input['tanggal_sk'] = date('Y-m-d');
        $input['status_approval'] = 'STEP-1';
        if ($input['status_barang'] == Constant::$SENSUS_STATUS_01[3]) {
            $input['status_approval'] = 'STEP-1';
        }

        $input['created_by'] = Auth::user()->id;

        $isExistedSensus = $this->all([
            'date_part(\'year\', created_at)' => date('Y'),
            'idinventaris' => $input['idinventaris']
        ])->first();

        if (!empty($isExistedSensus)) {
            $isExistedSensus->status_approval = 'STEP-1';
            $this->update($isExistedSensus->toArray(), $isExistedSensus->id);
            $sensus = $isExistedSensus;
        } else {
            $sensus = $this->create($input);
        }

        $isInventarisExist = inventaris::find((int)$input['idinventaris']);

        if (!empty($isInventarisExist)) {
            $isInventarisExist->id_sensus = $sensus->id;
            $isInventarisExist->save();
        }

        $request->merge(['idsensus' => $sensus->id]);

        // if (Access::is([],[],[Constant::$GROUP_BPKAD_ORG])) {
        //     $input['status_approval'] = 'STEP-2';
        // }




        $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "inventaris", function ($metadatas, $index, $systemUpload) {
            if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
            }

            $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];
            $systemUpload->foreign_field = 'id';
            $systemUpload->jenis = 'dokumen';
            $systemUpload->foreign_table = 'sensus';
            $systemUpload->foreign_id = $metadatas['idsensus'];

            return $systemUpload;
        });




        return $sensus;
    }


    public function count($req)
    {
        $count = [
            'step1' => 0,
            'step2' => 0,
            'step3' => 0
        ];

        $count['step1'] = count($this->allQuery()->select([
            'inventaris_sensus.id'
        ])
            ->where([
                'inventaris_sensus.status_approval' => 'STEP-1',
                //'inventaris_sensus.created_by' => Auth::id()
            ])
            ->get());


        return response()->json([
            'data' => $count
        ]);
    }
}
