<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedetiltanahAPIRequest;
use App\Http\Requests\API\UpdatedetiltanahAPIRequest;
use App\Models\detiltanah;
use App\Repositories\detiltanahRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;
use App\Helpers\Constant;

/**
 * Class detiltanahController
 * @package App\Http\Controllers\API
 */

class detiltanahAPIController extends AppBaseController
{
    /** @var  detiltanahRepository */
    private $detiltanahRepository;

    public function __construct(detiltanahRepository $detiltanahRepo)
    {
        $this->middleware('auth:api');
        $this->detiltanahRepository = $detiltanahRepo;
    }

    /**
     * Display a list detiltanah by pidinventaris.
     * GET|HEAD /detiltanahs
     *
     * @param Request $request
     * @return Response
     */
    public function byinventaris($pidinvetaris)
    {


        $detiltanahs = \App\Models\detiltanah::where(['pidinventaris' => $pidinvetaris])->first();

        return $this->sendResponse($detiltanahs, 'Detiltanahs retrieved successfully');
    }

    /**
     * Display a listing of the detiltanah.
     * GET|HEAD /detiltanahs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $organisasiUser = \App\Models\organisasi::find(Auth::user()->pid_organisasi);

        $fieldText = "concat(inventaris.kode_barang, ' - ', inventaris.noreg, ' - ', inventaris.tahun_perolehan)";

        if ($request->__isset("fieldText")) {
            $fieldText = $request->input("fieldText");
        }

        $query = \App\Models\detiltanah::selectRaw(
            $fieldText." as text, detil_tanah.*, inventaris.alamat_kota, inventaris.alamat_kecamatan, inventaris.alamat_kelurahan, inventaris.alamat_propinsi
        ")
        ->leftJoin('m_alamat as al_kota', 'al_kota.id', 'detil_tanah.idkota')
        ->leftJoin('m_alamat as al_kecamatan', 'al_kecamatan.id', 'detil_tanah.idkecamatan')
        ->leftJoin('inventaris', 'inventaris.id', 'detil_tanah.pidinventaris')
        ->leftJoin('m_organisasi', 'm_organisasi.id', 'inventaris.pid_organisasi');


        if ($request->__isset("q")) {
            $query = $query->whereRaw("inventaris.kode_barang like '%".$request->input("term")."%'")
            ->orWhereRaw("inventaris.tahun_perolehan like '%".$request->input("term")."%'")
            ->orWhereRaw("inventaris.noreg like '%".$request->input("term")."%'");
        }


        if ($request->__isset("addWhere")) {
            foreach ($request->input("addWhere") as $key => $value) {
                $query = $query->whereRaw($value);
            }
        }

        if ($organisasiUser->level == Constant::$GROUP_OPD_ORG) {
            $query = $query
                ->whereRaw('( inventaris.pid_organisasi = '.$organisasiUser->id.' OR m_organisasi.pid = '.$organisasiUser->id . ')')
                ->where('m_organisasi.level', '>=', $organisasiUser->jabatans);
        } else if ($organisasiUser->level == Constant::$GROUP_CABANGOPD_ORG) {
            $query = $query
                ->whereRaw(' ( inventaris.pid_organisasi = '.$organisasiUser->id . ' OR m_organisasi.id = ' . $organisasiUser->pid . ' ) ')
                ->where('m_organisasi.level', '>=', Constant::$GROUP_OPD_ORG);
        }

        $detiltanahs = $query
        ->get();

        return $this->sendResponse($detiltanahs->toArray(), 'Detiltanahs retrieved successfully');
    }

    /**
     * Store a newly created detiltanah in storage.
     * POST /detiltanahs
     *
     * @param CreatedetiltanahAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedetiltanahAPIRequest $request)
    {
        $input = $request->all();

        $detiltanah = $this->detiltanahRepository->create($input);

        return $this->sendResponse($detiltanah->toArray(), 'Detiltanah saved successfully');
    }

    /**
     * Display the specified detiltanah.
     * GET|HEAD /detiltanahs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var detiltanah $detiltanah */
        $detiltanah = \App\Models\detiltanah::select([
            'detil_tanah.*',
            'al_kota.nama as nama_kota',
            'al_kecamatan.nama as nama_kecamatan',
        ])
        ->leftJoin('m_alamat as al_kota', 'al_kota.id', 'detil_tanah.idkota')
        ->leftJoin('m_alamat as al_kecamatan', 'al_kecamatan.id', 'detil_tanah.idkecamatan')
        ->leftJoin('inventaris', 'inventaris.id', 'detil_tanah.pidinventaris')
        ->where(['detil_tanah.id' => $id])->first();

        if (empty($detiltanah)) {
            return $this->sendError('Detiltanah not found');
        }

        return $this->sendResponse($detiltanah->toArray(), 'Detiltanah retrieved successfully');
    }

    /**
     * Update the specified detiltanah in storage.
     * PUT/PATCH /detiltanahs/{id}
     *
     * @param int $id
     * @param UpdatedetiltanahAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetiltanahAPIRequest $request)
    {
        $input = $request->all();

        /** @var detiltanah $detiltanah */
        $detiltanah = $this->detiltanahRepository->find($id);

        if (empty($detiltanah)) {
            return $this->sendError('Detiltanah not found');
        }

        $detiltanah = $this->detiltanahRepository->update($input, $id);

        return $this->sendResponse($detiltanah->toArray(), 'detiltanah updated successfully');
    }

    /**
     * Remove the specified detiltanah from storage.
     * DELETE /detiltanahs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var detiltanah $detiltanah */
        $detiltanah = $this->detiltanahRepository->find($id);

        if (empty($detiltanah)) {
            return $this->sendError('Detiltanah not found');
        }

        $detiltanah->delete();

        return $this->sendResponse($id, 'Detiltanah deleted successfully');
    }
}
