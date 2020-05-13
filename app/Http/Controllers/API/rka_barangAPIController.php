<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createrka_barangAPIRequest;
use App\Http\Requests\API\Updaterka_barangAPIRequest;
use App\Models\rka_barang;
use App\Repositories\rka_barangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

/**
 * Class rka_barangController
 * @package App\Http\Controllers\API
 */

class rka_barangAPIController extends AppBaseController
{
    /** @var  rka_barangRepository */
    private $rka_barangRepository;

    public function __construct(rka_barangRepository $rka_barangRepo)
    {
        $this->rka_barangRepository = $rka_barangRepo;
    }

    public function lookup(Request $request)
    {
        $rka_barang = new rka_barang();

        $queryFiltered = \App\Helpers\LookupHelper::build($rka_barang, $request)
            ->join('m_organisasi', 'organisai.kode', 'rka_barang.kode_organisasi')
            ->where('m_organisasi.id', Auth::user()->pid_organisasi)
            ->where('rka_barang.tahun_rka', date('Y'));

        $recordsFiltered = $queryFiltered->count();

        if ($request->input('start') != null) {
            $queryFiltered = $queryFiltered->skip($request->input('start'));
        }

        if ($request->input('length') != null) {
            $queryFiltered = $queryFiltered->limit($request->input('length'));
        }

        $rows = $queryFiltered->get();

        return json_encode([
            'data' => $rows->toArray(),
            'recordsFiltered' => $recordsFiltered,
            'recordsTotal' => $rka_barang->count(),
        ]);
    }

    /**
     * Display a listing of the rka_barang.
     * GET|HEAD /rka_barangs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $queryrka_barang =  new \App\Models\rka_barang;

        $queryrka_barangFinal = $queryrka_barang;

      $rka_barangs = $queryrka_barangFinal
            ->join('m_organisasi', 'organisai.kode', 'rka_barang.kode_organisasi')
            ->where('m_organisasi.id', Auth::user()->pid_organisasi)
            ->limit(10)
            ->get();

        return $this->sendResponse($rka_barangs->toArray(), 'rka_barangs retrieved successfully');
    }

    /**
     * Store a newly created rka_barang in storage.
     * POST /rka_barangs
     *
     * @param Createrka_barangAPIRequest $request
     *
     * @return Response
     */
    public function store(Createrka_barangAPIRequest $request)
    {
        $input = $request->all();

        $rka_barang = $this->rka_barangRepository->create($input);

        return $this->sendResponse($rka_barang->toArray(), 'rka_barang saved successfully');
    }

    /**
     * Display the specified rka_barang.
     * GET|HEAD /rka_barangs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var rka_barang $rka_barang */
        $rka_barang = $this->rka_barangRepository->find($id);

        if (empty($rka_barang)) {
            return $this->sendError('RKA Barang not found');
        }

        $rka_barang->kode_rka_barang = rka_barang::buildKoderka_barang($rka_barang);
        $rka_barang->nama_kode_rka_barang_formated = "{$rka_barang->kode_rka_barang} - {$rka_barang->nama_rek_aset}";

        return $this->sendResponse($rka_barang->toArray(), 'rka_barang retrieved successfully');
    }

    /**
     * Update the specified rka_barang in storage.
     * PUT/PATCH /rka_barangs/{id}
     *
     * @param int $id
     * @param Updaterka_barangAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updaterka_barangAPIRequest $request)
    {
        $input = $request->all();

        /** @var rka_barang $rka_barang */
        $rka_barang = $this->rka_barangRepository->find($id);

        if (empty($rka_barang)) {
            return $this->sendError('rka_barang not found');
        }

        $rka_barang = $this->rka_barangRepository->update($input, $id);

        return $this->sendResponse($rka_barang->toArray(), 'rka_barang updated successfully');
    }

    /**
     * Remove the specified rka_barang from storage.
     * DELETE /rka_barangs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var rka_barang $rka_barang */
        $rka_barang = $this->rka_barangRepository->find($id);

        if (empty($rka_barang)) {
            return $this->sendError('rka_barang not found');
        }

        $rka_barang->delete();

        return $this->sendResponse($id, 'rka_barang deleted successfully');
    }
}

