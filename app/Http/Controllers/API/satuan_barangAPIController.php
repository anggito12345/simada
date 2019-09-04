<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createsatuan_barangAPIRequest;
use App\Http\Requests\API\Updatesatuan_barangAPIRequest;
use App\Models\satuan_barang;
use App\Repositories\satuan_barangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class satuan_barangController
 * @package App\Http\Controllers\API
 */

class satuan_barangAPIController extends AppBaseController
{
    /** @var  satuan_barangRepository */
    private $satuanBarangRepository;

    public function __construct(satuan_barangRepository $satuanBarangRepo)
    {
        $this->satuanBarangRepository = $satuanBarangRepo;
    }

    /**
     * Display a listing of the satuan_barang.
     * GET|HEAD /satuanBarangs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $satuanBarangs = \App\Models\satuan_barang::select([
            'nama as text',
            'id'
        ])
        ->whereRaw("nama like '%".$request->input("q")."%'")
        ->limit(10)
        ->get();

        return $this->sendResponse($satuanBarangs->toArray(), 'Satuan Barangs retrieved successfully');
    }

    /**
     * Store a newly created satuan_barang in storage.
     * POST /satuanBarangs
     *
     * @param Createsatuan_barangAPIRequest $request
     *
     * @return Response
     */
    public function store(Createsatuan_barangAPIRequest $request)
    {
        $input = $request->all();

        $satuanBarang = $this->satuanBarangRepository->create($input);

        return $this->sendResponse($satuanBarang->toArray(), 'Satuan Barang saved successfully');
    }

    /**
     * Display the specified satuan_barang.
     * GET|HEAD /satuanBarangs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var satuan_barang $satuanBarang */
        $satuanBarang = $this->satuanBarangRepository->find($id);

        if (empty($satuanBarang)) {
            return $this->sendError('Satuan Barang not found');
        }

        return $this->sendResponse($satuanBarang->toArray(), 'Satuan Barang retrieved successfully');
    }

    /**
     * Update the specified satuan_barang in storage.
     * PUT/PATCH /satuanBarangs/{id}
     *
     * @param int $id
     * @param Updatesatuan_barangAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesatuan_barangAPIRequest $request)
    {
        $input = $request->all();

        /** @var satuan_barang $satuanBarang */
        $satuanBarang = $this->satuanBarangRepository->find($id);

        if (empty($satuanBarang)) {
            return $this->sendError('Satuan Barang not found');
        }

        $satuanBarang = $this->satuanBarangRepository->update($input, $id);

        return $this->sendResponse($satuanBarang->toArray(), 'satuan_barang updated successfully');
    }

    /**
     * Remove the specified satuan_barang from storage.
     * DELETE /satuanBarangs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var satuan_barang $satuanBarang */
        $satuanBarang = $this->satuanBarangRepository->find($id);

        if (empty($satuanBarang)) {
            return $this->sendError('Satuan Barang not found');
        }

        $satuanBarang->delete();

        return $this->sendResponse($id, 'Satuan Barang deleted successfully');
    }
}
