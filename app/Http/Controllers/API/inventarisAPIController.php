<?php

namespace App\Http\Controllers\API;

use App\Helpers\Constant;
use App\Http\Requests\API\CreateinventarisAPIRequest;
use App\Http\Requests\API\UpdateinventarisAPIRequest;
use App\Models\inventaris;
use App\Repositories\inventarisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\barang;
use App\Repositories\inventaris_historyRepository;
use App\Repositories\inventaris_reklasRepository;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;
use c;

/**
 * Class inventarisController
 * @package App\Http\Controllers\API
 */

class inventarisAPIController extends AppBaseController
{
    /** @var  inventarisRepository */
    private $inventarisRepository;
    private $inventaris_historyRepository;
    private $inventaris_reklasRepository;

    public function __construct(
        inventarisRepository $inventarisRepo,
        inventaris_historyRepository $inventaris_historyRepository,
        inventaris_reklasRepository $inventaris_reklasRepository)
    {
        $this->middleware('auth:api');
        $this->inventarisRepository = $inventarisRepo;
        $this->inventaris_historyRepository = $inventaris_historyRepository;
        $this->inventaris_reklasRepository = $inventaris_reklasRepository;


    }

    /**
     * displaying sum of value based on current filter parameters
     */
    public function getSumHargaSatuan(Request $request) {
        $isDraft = isset($_GET['draft']) && $_GET['draft'] != 0 ? $_GET['draft'] : null;

        $buildingModel = inventarisRepository::getData($isDraft);

        $buildingModel = inventarisRepository::appendInventarisGridFilter($buildingModel, $_GET);

        $hargaSatuanPerpage = 0;

        $dataPerPage = $buildingModel->skip((int)$request->get('start'))->take((int)$request->get('length'))->get()->toArray();
        foreach ($dataPerPage as $key => $value) {
            $hargaSatuanPerpage += (float)$value['harga_satuan'];
        }

        return $this->sendResponse([
            'per_page' => number_format($hargaSatuanPerpage, 2),
            'all_page' => number_format(inventarisRepository::appendInventarisGridFilter(inventarisRepository::getData($isDraft), $_GET)->sum('inventaris.harga_satuan'), 2),
        ], 'Inventaris retrieved successfully');
    }

    public function getInventarisFromPenghapusan(Request $request) {
        inventarisRepository::getDataInventarisFromPenghapusan();
    }

    /**
     * Display a listing of the inventaris.
     * GET|HEAD /inventaris
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = \App\Models\inventaris::select([
            'inventaris.noreg as text',
            'inventaris.id',
            'inventaris.tahun_perolehan',
            'inventaris.harga_satuan',
            'm_barang.nama_rek_aset',
            'm_barang.kode_akun',
            'm_barang.kode_kelompok',
            'm_barang.kode_jenis',
            'm_barang.kode_objek',
            'm_barang.kode_rincian_objek',
            'm_barang.kode_sub_rincian_objek',
            'm_barang.kode_sub_sub_rincian_objek',
        ])
            ->whereRaw("(inventaris.noreg ~* '" . $request->input("q") . "' OR m_barang.nama_rek_aset ~* '" . $request->input("q") . "' )")
            ->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
            ->leftJoin('reklas_detil', 'reklas_detil.pidinventaris', 'inventaris.id');

        if ($request->has('own')) {
            $mineJabatan = \App\Models\jabatan::find(Auth::user()->jabatan);

            $query = $query->join("users", "users.id", "inventaris.idpegawai")
                ->join("m_jabatan", "m_jabatan.id", 'users.jabatan')
                ->where('m_jabatan.level', '<=', $mineJabatan->level)
                ->where('inventaris.pid_organisasi', '=', Auth::user()->pid_organisasi);
        }

        if ($request->has('same_org')) {

            $query = $query
                ->where('inventaris.pid_organisasi', '=', Auth::user()->pid_organisasi);
        }

        if ($request->has('nin') && $request->input('nin') != "") {
            $query = $query->whereRaw('inventaris.id NOT IN (' . $request->input('nin') . ')');
        }

        if ($request->has('is_exist_reklas')) {
            $query = $query->whereRaw('reklas_detil.id is null');
        }

        $inventaris = $query
            ->get();

        return $this->sendResponse($inventaris->toArray(), 'Inventaris retrieved successfully');
    }

    /**
     * Store a newly created inventaris in storage.
     * POST /inventaris
     *
     * @param CreateinventarisAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateinventarisAPIRequest $request)
    {
        $input = $request->all();

        $input['idpegawai'] = $request->user()->id;
        $input['pid_organisasi'] = $request->user()->pid_organisasi;
        $input['harga_satuan'] = str_replace(".", "", $input['harga_satuan']);

        // generate no register
        $modelInventaris = new \App\Models\inventaris();

        $barangMaster = \App\Models\barang::find($input['pidbarang']);

        $currentNoReg = DB::table($modelInventaris->table)
            ->select([
                'inventaris.*',
            ])
            ->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
            ->where('m_barang.kode_jenis', '=', $barangMaster->kode_jenis)
            ->where('inventaris.pid_organisasi', '=', $request->user()->pid_organisasi)
            ->where('inventaris.tahun_perolehan', '=', $input['tahun_perolehan'])
            ->orderBy('inventaris.noreg', 'desc')
            ->lockForUpdate()->first();

        $lastNoReg = 0;
        if ($currentNoReg != null) {
            $lastNoReg = (int) $currentNoReg->noreg;
        }
        for ($i = 0; $i < $input['jumlah']; $i++) {

            $input['noreg'] = sprintf('%03d', $lastNoReg + 1);

            $barang = barang::find($input['pidbarang']);

            if (empty($barang)) {
                throw new Exception('Barang not found');
                return;
            }

            $input['umur_ekonomis'] = $barang->umur_ekonomis;
            $input['kode_lokasi'] = inventarisRepository::generateKodeLokasi($input);



            $inventaris = $this->inventarisRepository->create($input);

            $request->merge(['idinventaris' => $inventaris["id"]]);

            $fileDokumens = [];
            $fileFotos = [];

            DB::beginTransaction();
            try {

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

                $kibData = json_decode($input['kib'], true);

                $kibData['pidinventaris'] = $inventaris->id;

                inventarisRepository::saveKib($kibData, $input['tipe_kib']);

                $inventarisHistory = $inventaris->toArray();

                $this->inventaris_historyRepository->postHistory($inventarisHistory, Constant::$ACTION_HISTORY['NEW']);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                \App\Helpers\FileHelpers::deleteAll($fileDokumens);
                \App\Helpers\FileHelpers::deleteAll($fileFotos);
                \App\Models\inventaris::find($inventaris->id)->delete();
                return $this->sendError($e->getMessage() . $e->getTraceAsString());
            }

            $lastNoReg++;
        }


        return $this->sendResponse([], 'inventaris updated successfully');
    }

    /** bridge to calculating the value is intra or ekstra
     *
     *
     */

    public function intraorekstra(Request $request)
    {
        try {
            $calculated = \App\Models\inventaris::CalculateIsIntraOrEkstra($request->tahun_perolehan, (int) str_replace(",",".",str_replace(".", "", $request->harga_satuan)));
            return $this->sendResponse($calculated, 'success');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Display the specified inventaris.
     * GET|HEAD /inventaris/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var inventaris $inventaris */
        $inventaris = \App\Models\inventaris::withDrafts()->select([
            'inventaris.*',
            'm_barang.nama_rek_aset',
            'm_barang.kode_akun',
            'm_barang.kode_kelompok',
            'm_barang.kode_jenis',
            'm_barang.kode_objek',
            'm_barang.kode_rincian_objek',
            'm_barang.kode_sub_rincian_objek',
            'm_barang.kode_sub_sub_rincian_objek',
        ])->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
            ->find($id);

        if (empty($inventaris)) {
            return $this->sendError('Inventaris not found');
        }

        $inventaris->kode_barang = Barang::buildKodeBarang($inventaris);
        $inventaris->nama_kode_barang_formated = "{$inventaris->kode_barang} - {$inventaris->nama_rek_aset}";

        return $this->sendResponse($inventaris->toArray(), 'Inventaris retrieved successfully');
    }

    /**
     * mutasi data ke kib c atau d
     * PUT /mutasi/{id}
     *
     * @param int $id
     * @param UpdateinventarisAPIRequest $request
     *
     * @return Response
     */
    public function mutasi($id, Request $request)
    {
        return $this->inventaris_reklasRepository->doMutationStageFirst($request, $id);
    }

    /**
     * Update the specified inventaris in storage.
     * PUT/PATCH /inventaris/{id}
     *
     * @param int $id
     * @param UpdateinventarisAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinventarisAPIRequest $request)
    {
        $update_inventaris_setting = \App\Models\setting::where('nama', \Constant::$SETTING_UBAH_PENATA_USAHAAN)->first()->nilai;

        $input = $request->all();

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

            $input['kode_lokasi'] = inventarisRepository::generateKodeLokasi($input);

            $inventaris = $this->inventarisRepository->update($input, $id);

            $kibData = json_decode($input['kib'], true);

            $kibData['pidinventaris'] = $id;

            inventarisRepository::saveKib($kibData, $input['tipe_kib']);

            $inventarisHistory = $inventaris->toArray();

            $this->inventaris_historyRepository->postHistory($inventarisHistory, Constant::$ACTION_HISTORY["UPDATE"]);

            DB::commit();

            return $this->sendResponse($inventaris->toArray(), 'inventaris updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            \App\Helpers\FileHelpers::deleteAll($fileFotos);
            return $this->sendError($e->getMessage() . $e->getTraceAsString());
        }

        return $this->sendResponse($inventaris->toArray(), 'inventaris updated successfully');
    }

    /**
     * Remove the specified inventaris from storage.
     * DELETE /inventaris/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ids = explode("|", $id);

        foreach ($ids as $key => $id) {
            # code...
            /** @var inventaris $inventaris */

            DB::beginTransaction();
            try {
                $inventaris = inventaris::withDrafts()->find($id);
                if (empty($inventaris)) {
                    return $this->sendError('Inventaris not found');
                }

                $querySystemUpload = \App\Models\system_upload::where([
                    'foreign_table' => 'inventaris',
                    'foreign_id' => $id,
                ]);

                // delete all history

                $dataSystemUploads = $querySystemUpload->get();

                foreach ($dataSystemUploads as $key => $value) {
                    Storage::delete($value->path);
                }

                $querySystemUpload->delete();

                $inventaris->forceDelete();

                DB::commit();
            } catch (\Exception $e) {


                DB::rollBack();

                return $this->sendError($e->getMessage() . $e->getTraceAsString());
            }
        }


        return $this->sendResponse($id, 'Inventaris deleted successfully');
    }

    /**
     * Handle geenerate lokasi request.
     * POST /generateLokasi
     *
     * @param Request $request
     * @return Response
     */
    public function generateKodeLokasi(Request $request)
    {
        try {
            $kodeLokasi = $this->inventarisRepository->generateKodeLokasi($request);
            return $this->sendResponse($kodeLokasi, 'success');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Handle save dokumen kronologis.
     * POST /inventaris/dokumenkronologis
     *
     * @param Request $request
     * @return Response
     */
    public function saveDokumenKronologis(Request $request)
    {
        $input = $request->all();

        $inventaris = inventaris::withDrafts()
            ->with('Organisasi')
            ->find($input['id']);

        $organisasi = \App\Models\organisasi::find(Auth::user()->pid_organisasi);

        if ($organisasi->id != $inventaris->pid_organisasi && !c::is('inventaris',['update'],[Constant::$GROUP_BPKAD_ORG])) {
            return $this->sendError('Tidak bisa menyimpan dokumen kronologis inventaris');
        }

        $fileDokumens = [];

        DB::beginTransaction();
        try {

            $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen_kronologis', $request, "inventaris", function ($metadatas, $index, $systemUpload) {
                if (isset($metadatas['dokumen_kronologis_metadata_keterangan'][$index]) && $metadatas['dokumen_kronologis_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['dokumen_kronologis_metadata_keterangan'][$index];
                }
                $systemUpload->uid = $metadatas['dokumen_kronologis_metadata_uid'][$index];
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'dokumen_kronologis';
                $systemUpload->foreign_table = 'inventaris';
                $systemUpload->foreign_id = $metadatas['dokumen_kronologis_metadata_id_inventaris'][$index];

                return $systemUpload;
            });

            DB::commit();

            return $this->sendResponse($inventaris->toArray(), 'dokumen kronologis saved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            return $this->sendError($e->getMessage() . $e->getTraceAsString());
        }

        return $this->sendResponse($inventaris->toArray(), 'dokumen kronologis saved successfully');
    }

    public function konfirmasiDraft(Request $request) {
        $inventaris = inventaris::withDrafts()
            ->with('Organisasi')
            ->find($request->id);

        $inventaris->draft = NULL;

        if ($inventaris->save()) {
            return $this->sendResponse($request->id, 'success');
        } else {
            return $this->sendError($e->getMessage());
        }
    }
}
