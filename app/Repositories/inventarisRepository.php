<?php

namespace App\Repositories;

use App\Models\inventaris;
use App\Models\inventaris_sensus;
use App\Models\ubah_satuan_stagging;
use App\Repositories\BaseRepository;
use Constant;
use Auth;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container as Application;
use c;

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
        'kode_barang'
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

    /**
     * its called when penghapusan needed to get data inventaris
     *
     */
    public static function getDataInventarisFromPenghapusan() {
        return [];
    }

    public static function saveKib($dataKib, $tipe) {
        $rules = [];

        switch ($tipe) {
            case 'A':
                $rules = \App\Models\detiltanah::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                if(array_key_exists('koordinattanah', $dataKib) && is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
                }


                if (array_key_exists('tgl_sertifikat', $dataKib)) {
                    $dataKib['tgl_sertifikat'] = date("Y-m-d", strtotime($dataKib['tgl_sertifikat']));
                } else {
                    $dataKib['tgl_sertifikat'] = date('Y-m-d');
                }


                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_tanah')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_tanah')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_tanah')->insert($dataKib);
                break;
            case 'B':
                $rules = \App\Models\detilmesin::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_mesin')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_mesin')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_mesin')->insert($dataKib);

                break;
            case 'C':
                $rules = \App\Models\detilbangunan::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                if(isset($dataKib['koordinattanah']) && is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
                }

                if(array_key_exists('tgldokumen', $dataKib) && $dataKib['tgldokumen'] != '') {
                    $dataKib['tgldokumen'] = date("Y-m-d", strtotime($dataKib['tgldokumen']));
                } else {
                    $dataKib['tgldokumen'] = date('Y-m-d');
                }

                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_bangunan')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_bangunan')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_bangunan')->insert($dataKib);
                break;
            case 'D':
                $rules = \App\Models\detiljalan::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }


                if (isset($dataKib['panjang']))
                    $dataKib['panjang'] = str_replace('.', '', $dataKib['panjang']);
                if (isset($dataKib['lebar']))
                    $dataKib['lebar'] = str_replace('.', '', $dataKib['lebar']);
                if (isset($dataKib['luas']))
                    $dataKib['luas'] = str_replace('.', '', $dataKib['luas']);

                if(isset($dataKib['koordinattanah']) && is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
                }

                if (array_key_exists('tgldokumen', $dataKib) && $dataKib['tgldokumen'] != '') {
                    $dataKib['tgldokumen'] = date("Y-m-d", strtotime($dataKib['tgldokumen']));
                } else {
                    $dataKib['tgldokumen'] = date('Y-m-d');
                }

                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_jalan')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_jalan')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }
                DB::table('detil_jalan')->insert($dataKib);
                break;
            case 'E':
                $rules = \App\Models\detiljalan::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_aset_lainnya')->where('pidinventaris', $dataKib['pidinventaris'])->count();

                    if ($exist > 0 ) {
                        DB::table('detil_aset_lainnya')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_aset_lainnya')->insert($dataKib);
                break;
            case 'F':
                $rules = \App\Models\detilkonstruksi::$rules;
                $validator = Validator::make($dataKib, $rules);

                if ($validator->fails()) {
                    throw new \Exception($validator);
                    return;
                }

                $dataKib['luasbangunan'] = str_replace('.', '', $dataKib['luasbangunan']);

                if(array_key_exists('koordinattanah', $dataKib) && is_array($dataKib['koordinattanah'])) {
                    $dataKib['koordinattanah'] = json_encode($dataKib['koordinattanah']);
                }

                if(array_key_exists('tgl_dokumen', $dataKib) && $dataKib['tgl_dokumen'] != '') {
                    $dataKib['tgldokumen'] = date("Y-m-d", strtotime($dataKib['tgl_dokumen']));
                } else {
                    $dataKib['tgldokumen'] = date('Y-m-d');
                }

                if(array_key_exists('tglmulai', $dataKib) && $dataKib['tglmulai'] != '') {
                    $dataKib['tglmulai'] = date("Y-m-d", strtotime($dataKib['tglmulai']));
                } else {
                    $dataKib['tglmulai'] = date('Y-m-d');
                }


                if (isset($dataKib['pidinventaris']) && $dataKib['pidinventaris'] != null && $dataKib['pidinventaris'] != "") {
                    $exist = DB::table('detil_konstruksi')->where('pidinventaris', $dataKib['pidinventaris'])->count();


                    if ($exist > 0 ) {
                        DB::table('detil_konstruksi')->where('pidinventaris', $dataKib['pidinventaris'])->update($dataKib);
                        break;
                    }
                }

                DB::table('detil_konstruksi')->insert($dataKib);
            default:
                break;
        }
    }

    public static function UpdateLogic($input, $id,$request = null) {

        if ($input['id_sensus'] == 'null' || $input['is_ubah_satuan'] != 'null') {
            $input['id_sensus'] = null;
        }


        if ($input['is_ubah_satuan'] == 'null') {
            $input['is_ubah_satuan'] = null;

        }

        $update_inventaris_setting = \App\Models\setting::where('nama', \Constant::$SETTING_UBAH_PENATA_USAHAAN)->first()->nilai;
        /** @var inventaris $inventaris */
        $inventaris = inventaris::withDrafts()
            ->with('Organisasi')
            ->find($id);

        $organisasi = \App\Models\organisasi::find(Auth::user()->pid_organisasi);

        if ($organisasi->id != $inventaris->pid_organisasi && !c::is('inventaris',['update'],[Constant::$GROUP_BPKAD_ORG])) {
            return $this->sendError('Tidak bisa mengubah data inventaris');
        }

        if (empty($inventaris->draft) && strtolower($update_inventaris_setting) != 'true') {
            return $this->sendError('Tidak bisa mengubah data inventaris yang bukan draft');
        }

        if (empty($inventaris)) {
            return $this->sendError('Inventaris not found');
        }

        if (c::is('',[],[0]) && empty($inventaris->organisasi->setting)) {
            return $this->sendError('Setting OPD dikunci. Inventaris tidak dapat diubah');
        }

        $fileDokumens = [];
        $fileFotos = [];

        DB::beginTransaction();
        try {
            if (isset($request)) {
                $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "inventaris", function ($metadatas, $index, $systemUpload) {
                    if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                        $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                    }

                    $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];
                    $systemUpload->foreign_field = 'id';
                    $systemUpload->jenis = 'dokumen';
                    $systemUpload->foreign_table = 'inventaris';
                    $systemUpload->foreign_id = $metadatas['dokumen_metadata_id_inventaris'][$index];

                    return $systemUpload;
                });


                $fileFotos = \App\Helpers\FileHelpers::uploadMultiple('foto', $request, "inventaris", function ($metadatas, $index, $systemUpload) {
                    if (isset($metadatas['foto_metadata_keterangan'][$index]) && $metadatas['foto_metadata_keterangan'][$index] != null) {
                        $systemUpload->keterangan = $metadatas['foto_metadata_keterangan'][$index];
                    }
                    $systemUpload->uid = $metadatas['foto_metadata_uid'][$index];
                    $systemUpload->foreign_field = 'id';
                    $systemUpload->jenis = 'foto';
                    $systemUpload->foreign_table = 'inventaris';
                    $systemUpload->foreign_id = $metadatas['foto_metadata_id_inventaris'][$index];

                    return $systemUpload;
                });

            }


            $input['kode_lokasi'] = inventarisRepository::generateKodeLokasi($input);

            $kibData = json_decode($input['kib'], true);

            $kibData['pidinventaris'] = (int)$id;



            if (empty($input['id_sensus']) || $input['id_sensus'] == 'null') {

                $inventarisRepository = new inventarisRepository(new Application());

                $inventaris = $inventarisRepository->update($input, $id);

                inventarisRepository::saveKib($kibData, $input['tipe_kib']);

                $inventarisHistoryData = $inventaris->toArray();

                $inventarisHistory = new inventaris_historyRepository(new Application());
                $inventarisHistory->postHistory($inventarisHistoryData, Constant::$ACTION_HISTORY['NEW']);
            } else {

                $input['kib_data'] = $kibData;
                $input['id_sensus'] = (int)$input['id_sensus'];
                $sensus = \App\Models\inventaris_sensus::find($input['id_sensus']);
                $sensus->data_temporary = json_encode($input, 1);

                //check all data should be required


                $sensus->save();

            }



            DB::commit();

            return $inventaris;
        } catch (\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            \App\Helpers\FileHelpers::deleteAll($fileFotos);

            throw new Exception($e->getMessage() . "-" . $e->getFile() . "-" .$e->getLine());

            return "";
        }

        return $inventaris;
    }

    /**
     * insert logic
     */
    public static function InsertLogic($input, $request = null) {
        DB::beginTransaction();
        try {

            $idSensusTemp = null;

            if ($input['is_ubah_satuan'] != 'null') {
                $idSensusTemp = $input['id_sensus'];
            }


            if ($input['id_sensus'] == 'null' || $input['is_ubah_satuan'] != 'null') {
                $input['id_sensus'] = null;
            }


            if ($input['is_ubah_satuan'] == 'null') {
                $input['is_ubah_satuan'] = null;

            }



            // generate no register
            $modelInventaris = new \App\Models\inventaris();

            $barangMaster = \App\Models\barang::find($input['pidbarang']);

            $currentNoReg = DB::table($modelInventaris->table)
                ->select([
                    'inventaris.*',
                ])
                ->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
                ->where('inventaris.pidbarang', '=', $input["pidbarang"])
                ->where('m_barang.kode_jenis', '=', $barangMaster->kode_jenis)
                ->where('inventaris.tahun_perolehan', '=', $input['tahun_perolehan'])
                ->where('inventaris.harga_satuan', '=', str_replace(".","", $input['harga_satuan']))
                ->orderBy('inventaris.noreg', 'desc')
                ->lockForUpdate()->first();

            $lastNoReg = 0;
            if ($currentNoReg != null) {
                $lastNoReg = (int)$currentNoReg->noreg;
            }
            for ($i = 0; $i < $input['jumlah'] ; $i ++) {

                $input['noreg'] = sprintf('%03d',$lastNoReg + 1);

                $inventarisRepository = new inventarisRepository(new Application());

                $inventaris = $inventarisRepository->create($input);

                $lastNoReg++;

                if ($input['is_ubah_satuan'] != null) {
                    ubah_satuan_stagging::create([
                        'idinventaris' => $inventaris->id,
                        'id_sensus' => $idSensusTemp
                    ]);
                }
            }


            if (isset($request)) {
                $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "inventaris", function ($metadatas, $index, $systemUpload) {
                    if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                        $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                    }

                    $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];
                    $systemUpload->foreign_field = 'id';
                    $systemUpload->jenis = 'dokumen';
                    $systemUpload->foreign_table = 'inventaris';
                    $systemUpload->foreign_id = $metadatas['idinventaris'];

                    return $systemUpload;
                });


                $fileFotos = \App\Helpers\FileHelpers::uploadMultiple('foto', $request, "inventaris", function ($metadatas, $index, $systemUpload) {
                    if (isset($metadatas['foto_metadata_keterangan'][$index]) && $metadatas['foto_metadata_keterangan'][$index] != null) {
                        $systemUpload->keterangan = $metadatas['foto_metadata_keterangan'][$index];
                    }
                    $systemUpload->uid = $metadatas['foto_metadata_uid'][$index];
                    $systemUpload->foreign_field = 'id';
                    $systemUpload->jenis = 'foto';
                    $systemUpload->foreign_table = 'inventaris';
                    $systemUpload->foreign_id = $metadatas['idinventaris'];


                    return $systemUpload;
                });

            }

            if (isset($input["kib"])) {
                $kibData = json_decode($input['kib'], true);
            } else {
                $kibData = [];
            }


            $kibData['pidinventaris'] = $inventaris->id;

            inventarisRepository::saveKib($kibData, $input['tipe_kib']);

            $inventarisHistoryData = $inventaris->toArray();

            $inventarisHistory = new inventaris_historyRepository(new Application());
            $inventarisHistory->postHistory($inventarisHistoryData, Constant::$ACTION_HISTORY['NEW']);





            if ($input['id_sensus'] != null && $input['is_ubah_satuan'] != null) {

                $sensus = inventaris_sensus::find((int)$input['id_sensus']);
                if(!empty($sensus)) {
                    $sensus->idinventaris = (int)$inventaris->id;
                    $sensus->save();
                }

            }


            DB::commit();
        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());

            DB::rollBack();

            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * its need to be triggered when there are more than 1 filter that filled.
     * @jenisbarangs
     * @kodeobjek
     * @koderincianobjek
     * @kodesubrincianobjek
     * @organisasi_filter
     *
     * @is_exist_inventaris_penghapusan
     */
    public static function appendInventarisGridFilter($buildingModel = null, $theFilter = [])
    {
        $defRet = new \App\Models\inventaris();

        if ($buildingModel == null) {
            return  $defRet->newQuery();
        }

        if (isset($theFilter['except-id-inventaris'])) {
            $exceptIdInventaris = $theFilter['except-id-inventaris'];
            $buildingModel = $buildingModel->whereRaw('inventaris.id NOT IN ('.$exceptIdInventaris.')');
        }


        if (isset($theFilter['jenisbarangs']) && $theFilter['jenisbarangs'] != "" && $theFilter['jenisbarangs'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_jeniss', $_GET['jenisbarangs']);
        }

        if (isset($theFilter['kodeobjek']) && $theFilter['kodeobjek'] != "" && $theFilter['kodeobjek'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_objek', $theFilter['kodeobjek']);
        }

        if (isset($theFilter['koderincianobjek']) && $theFilter['koderincianobjek'] != "" && $theFilter['koderincianobjek'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_rincian_objek', $theFilter['koderincianobjek']);
        }

        if (isset($theFilter['kodesubrincianobjek']) && $theFilter['kodesubrincianobjek'] != "" && $theFilter['kodesubrincianobjek'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_sub_rincian_objek', $theFilter['kodesubrincianobjek']);
        }

        if (isset($theFilter['organisasi_filter']) && $theFilter['organisasi_filter'] != "" && $theFilter['organisasi_filter'] != null) {
            $buildingModel = $buildingModel->where('m_organisasi.id', $theFilter['organisasi_filter']);
        }

        if (isset($theFilter['penggunafilter']) && $theFilter['penggunafilter'] != "" && $theFilter['penggunafilter'] != null) {
            $buildingModel = $buildingModel->where('inventaris.pidopd', $theFilter['penggunafilter']);
        }

        if (isset($theFilter['kuasapengguna_filter']) && $theFilter['kuasapengguna_filter'] != "" && $theFilter['kuasapengguna_filter'] != null) {
            $buildingModel = $buildingModel->where('inventaris.pidopd_cabang', $theFilter['kuasapengguna_filter']);
        }

        if (isset($theFilter['subkuasa_filter']) && $theFilter['subkuasa_filter'] != "" && $theFilter['subkuasa_filter'] != null) {
            $buildingModel = $buildingModel->where('inventaris.pidupt', $theFilter['subkuasa_filter']);
        }

        if (isset($theFilter['status_sensus']) && $theFilter['status_sensus'] != "" && $theFilter['status_sensus'] != null) {
            //u can check constnt list status sensus on Constant class=

            // if ($theFilter['status_sensus'] == 1) {
            //     $buildingModel = $buildingModel->whereRaw('inventaris_sensus IS NULL');
            // } else if ($theFilter['status_sensus'] == 2) {
            //     $buildingModel = $buildingModel->whereRaw('inventaris_sensus.status_approval = \'STEP-1\'');
            // } else if ($theFilter['status_sensus'] == 3) {
            //     $buildingModel = $buildingModel->whereRaw('inventaris_sensus.status_approval = \'STEP-2\'');
            // } else {

            // }

        }


        // take data which is doesn't has any duplicate data in inventaris_penghapusan
        if(isset($theFilter['is_exist_inventaris_penghapusan'])) {

            // false it mean must not be in there
            if ($theFilter['is_exist_inventaris_penghapusan'] == 'false') {
                $buildingModel = $buildingModel
                                        ->whereRaw('inventaris_penghapusan.id IS NULL');
            }
        }


        return $buildingModel;

    }

    public static function getData($isDraft = null, $rawSelect = "", $buildingModel = null) {


        if ($buildingModel == null) {
            $buildingModel = new \App\Models\inventaris();
           // $buildingModel = $buildingModel->WithSensus();
        }


        if (isset($isDraft) && $isDraft == '1') {
            $buildingModel = $buildingModel->onlyDrafts();
        } else {
            $buildingModel = $buildingModel->NotDrafts();
        }

        $organisasiUser = \App\Models\organisasi::find(Auth::user()->pid_organisasi);
        if ($organisasiUser == null) {
            $organisasiUser = new \App\Models\organisasi();
        }

        if ($rawSelect == "") {
            $buildingModel = $buildingModel->select([
                "inventaris.*",
                "inventaris.noreg",
                "m_barang.nama_rek_aset",
                "m_merk_barang.nama as merk",
                "m_jenis_barang.kelompok_kib",
                "m_jenis_barang.nama as jenis",
                "detil_mesin.bahan as bahan",
                "m_organisasi.setting as setauth",
                "inventaris_penghapusan.id as ip",
                "inventaris_reklas.id as ir",
                "detil_mesin.norangka",
                "detil_mesin.nomesin",
                "detil_mesin.nopol"
            ])
            ->selectRaw('CONCAT(detil_tanah.nomor_sertifikat,\'/\',detil_mesin.nopabrik,\'/\', detil_mesin.norangka,\'/\', detil_mesin.nomesin) as nomor')
            ->selectRaw('CONCAT(\'1 \',m_satuan_barang.nama) as barang');
        } else {
            $buildingModel = $buildingModel->selectRaw($rawSelect);
        }

        $buildingModel = $buildingModel->join("m_barang", "m_barang.id", "inventaris.pidbarang")
            ->leftJoin("m_jenis_barang", "m_jenis_barang.kode", "m_barang.kode_jenis")
            // role =================
            ->leftJoin("users","users.id", "inventaris.idpegawai")
            ->leftJoin("m_jabatan", "m_jabatan.id", 'users.jabatan')
            ->leftJoin(app(ubah_satuan_stagging::class)->getTable(), app(ubah_satuan_stagging::class)->getTable().".idinventaris", "inventaris.id")
            ->leftJoin("inventaris_reklas", "inventaris.id", "inventaris_reklas.id")
            // role end
            ->leftJoin("detil_tanah", "detil_tanah.pidinventaris", "inventaris.id")
            ->leftJoin("m_satuan_barang", "m_satuan_barang.id", "inventaris.satuan")
            ->leftJoin("detil_mesin", "detil_mesin.pidinventaris", "inventaris.id")
            ->leftJoin("detil_bangunan", "detil_bangunan.pidinventaris", "inventaris.id")
            ->leftJoin("detil_aset_lainnya", "detil_aset_lainnya.pidinventaris", "inventaris.id")
            ->leftJoin("detil_jalan", "detil_jalan.pidinventaris", "inventaris.id")
            ->leftJoin("detil_konstruksi", "detil_konstruksi.pidinventaris", "inventaris.id")
            ->leftJoin("m_merk_barang", "m_merk_barang.id", "detil_mesin.merk")
            ->leftJoin('inventaris_penghapusan', 'inventaris_penghapusan.id', 'inventaris.id')
            ->leftJoin('m_organisasi', 'm_organisasi.id', 'inventaris.pid_organisasi');
        //     ->leftJoin('inventaris_sensus', function($join){
        //         $join->on("inventaris_sensus.idinventaris", "inventaris.id")->on(DB::raw("date_part('year', \"inventaris_sensus\".\"created_at\")"), DB::Raw(date('Y')));
        //    });

            // role =================
            // ->where('m_jabatan.level', '<=', $mineJabatan->level)

        //exclude data when still staging ubah data.
        $buildingModel = $buildingModel->whereRaw(app(ubah_satuan_stagging::class)->getTable().'.idinventaris IS NULL');
        // role conditional please check this whenever u want customizing role
        if ($organisasiUser->level == Constant::$GROUP_OPD_ORG) {
            $buildingModel = $buildingModel
                ->whereRaw('( inventaris.pid_organisasi = '.$organisasiUser->id.' OR m_organisasi.pid = '.$organisasiUser->id . ')')
                ->where('m_organisasi.level', '>=', $organisasiUser->jabatans);
        } else if ($organisasiUser->level == Constant::$GROUP_CABANGOPD_ORG) {
            $buildingModel = $buildingModel
                ->whereRaw(' ( inventaris.pid_organisasi = '.$organisasiUser->id . ' OR m_organisasi.id = ' . $organisasiUser->pid . ' ) ')
                ->where('m_organisasi.level', '>=', Constant::$GROUP_OPD_ORG);
        }

        return $buildingModel;
    }

    public static function generateKodeLokasi($req) {
        $kodeStatus = \App\Models\setting::where('nama', Constant::$SETTING_KODE_LOKASI_STATUS)->first()->nilai;
        $kodePropinsi = \App\Models\setting::where('nama', Constant::$SETTING_KODE_PROPINSI)->first()->nilai;
        $intraEkstra = \App\Models\inventaris::CalculateIsIntraOrEkstra($req['tahun_perolehan'], $req['harga_satuan']);
        $kodeKota = \App\Models\setting::where('nama', Constant::$SETTING_KODE_KOTA)->first()->nilai;

        $propinsi = \App\Models\alamat::find(!array_key_exists('alamat_propinsi', $req) ? -1 : $req['alamat_propinsi']);
        if (empty($propinsi)) {
            $propinsi = 0;
        } else {
            $propinsi = $propinsi->kode;
        }


        $kota = \App\Models\alamat::find(!array_key_exists('alamat_kota', $req) ? -1 : $req['alamat_kota']);
        if (empty($kota)) {
            $kota = 0;
        } else {
            $kota = $kota->kode;
        }

        $organisasiOpd = \App\Models\organisasi::find(!array_key_exists('pidopd', $req) ? -1 : $req['pidopd']);
        if (empty($organisasiOpd)) {
            $organisasiOpd = 0;
        } else {
            $organisasiOpd = $organisasiOpd->kode;
        }

        $organisasiOpdCabang = \App\Models\organisasi::find(!array_key_exists('pidopd_cabang', $req) ? -1 : $req['pidopd_cabang']);
        if (empty($organisasiOpdCabang)) {
            $organisasiOpdCabang = '00';
        } else {
            if(strlen($organisasiOpdCabang->kode) > 2) {
                $organisasiOpdCabang = substr($organisasiOpdCabang->kode, strlen($organisasiOpdCabang->kode) - 2, strlen($organisasiOpdCabang->kode));
            } else {
                $organisasiOpdCabang = $organisasiOpdCabang->kode;
            }

        }

        $organisasiUpt = \App\Models\organisasi::find(!array_key_exists('pidupt', $req) ? -1 : $req['pidupt']);
        if (empty($organisasiUpt)) {
            $organisasiUpt = '';
        } else {
            $organisasiUpt = $organisasiUpt->kode;
        }


        return $kodeStatus . '.' .
        $intraEkstra . '.' .
        $propinsi . '.' .
        $kota . '.' .
        $organisasiOpd . '.' .
        $organisasiOpdCabang . '.' .
        $organisasiUpt . '.' .
        $req['tahun_perolehan'];

    }

    public static function kodeBarang($pidBarang) {
        $barang = \App\Models\barang::find($pidBarang);
        $kode = "";
        if ($barang->kode_akun != null) {
            $kode .= $barang->kode_akun;
        }

        if ($barang->kode_kelompok != null) {
            $kode .= ".".$barang->kode_kelompok;
        }

        if ($barang->kode_jenis != null) {
            $kode .= ".".$barang->kode_jenis;
        }

        if ($barang->kode_objek != null) {
            $kode .= ".".$barang->kode_objek;
        }

        if ($barang->kode_rincian_objek != null) {
            $kode .= ".".$barang->kode_rincian_objek;
        }

        if ($barang->kode_sub_rincian_objek != null) {
            $kode .= ".".$barang->kode_sub_rincian_objek;
        }

        if ($barang->kode_sub_sub_rincian_objek != null) {
            $kode .= ".".$barang->kode_sub_sub_rincian_objek;
        }

        return $kode;
    }
}
