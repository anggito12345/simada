<?php

namespace App\Repositories;

use App\Helpers\Access;
use App\Models\inventaris;
use App\Models\inventaris_sensus;
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

    /**
     * approvement main logic sensus
     */

      /**
     * approving data penghapusan for bpkad
     */
    public function approvements($req, $inventaris_historyRepository)
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
                                    inventaris::where([
                                        'id' => $each->idinventaris
                                    ])->delete();
                                }

                                // when status barang is 1
                                if($each->status_barang == '1') {

                                    // when status ubah satuan is pisah
                                    if ($each->status_ubah_satuan == '0') {
                                        inventaris::where([
                                            'id' => $each->idinventaris
                                        ])->delete();
                                    }

                                    // otherwise will redirect to pemeliharaan
                                }


                                $each->update([
                                    'status_approval' => 'STEP-2'
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
            'm_barang.nama_rek_aset as nama',
            'inventaris_sensus.id as id',
            'inventaris_sensus.no_sk as no_sk',
            'inventaris_sensus.*',
            'inventaris.kode_barang as kode_barang',
            'inventaris.noreg as noreg',
            'inventaris_sensus.tanggal_sk as tanggal_sk',
            'inventaris_sensus.status_barang_hilang as status_barang_hilang',
            'inventaris_sensus.status_barang as status_barang',
            'm_organisasi.nama as pemohon'
        ])
        ->join('inventaris','inventaris.id','inventaris_sensus.idinventaris')
        ->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
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

        $input['tanggal_sk'] = date('Y-m-d');
        $input['status_approval'] = 'STEP-1';
        $input['created_by'] = Auth::user()->id;
        $sensus = $this->create($input);
        $request->merge(['idsensus' => $sensus->id]);

        if (Access::is([],[],[Constant::$GROUP_BPKAD_ORG])) {
            $input['status_approval'] = 'STEP-2';
        }



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

        if ($input['status_barang'] == Constant::$SENSUS_STATUS_01[0]) {
            //inventaris::find($input['idinventaris'])->delete();
        }


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
