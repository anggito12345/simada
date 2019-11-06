<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatelokasiAPIRequest;
use App\Http\Requests\API\UpdatelokasiAPIRequest;
use App\Models\lokasi;
use App\Repositories\lokasiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class lokasiController
 * @package App\Http\Controllers\API
 */

class lokasiAPIController extends AppBaseController
{
    /** @var  lokasiRepository */
    private $lokasiRepository;

    public function __construct(lokasiRepository $lokasiRepo)
    {
        $this->lokasiRepository = $lokasiRepo;
    }

    /**
     * Display a listing of the lokasi.
     * GET|HEAD /lokasis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $lokasis = \App\Models\lokasi::select([
            'nama as text',
            'id'
        ])
        ->whereRaw("nama like '%".$request->input("term")."%'")
         
        ->get();

        return $this->sendResponse($lokasis->toArray(), 'Lokasis retrieved successfully');
    }

    /**
     * Store a newly created lokasi in storage.
     * POST /lokasis
     *
     * @param CreatelokasiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatelokasiAPIRequest $request)
    {
        $input = $request->all();

        $lokasi = $this->lokasiRepository->create($input);

        return $this->sendResponse($lokasi->toArray(), 'Lokasi saved successfully');
    }

    /**
     * Display the specified lokasi.
     * GET|HEAD /lokasis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var lokasi $lokasi */
        $lokasi = $this->lokasiRepository->find($id);

        if (empty($lokasi)) {
            return $this->sendError('Lokasi not found');
        }

        return $this->sendResponse($lokasi->toArray(), 'Lokasi retrieved successfully');
    }

    /**
     * Update the specified lokasi in storage.
     * PUT/PATCH /lokasis/{id}
     *
     * @param int $id
     * @param UpdatelokasiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelokasiAPIRequest $request)
    {
        $input = $request->all();

        /** @var lokasi $lokasi */
        $lokasi = $this->lokasiRepository->find($id);

        if (empty($lokasi)) {
            return $this->sendError('Lokasi not found');
        }

        $lokasi = $this->lokasiRepository->update($input, $id);

        return $this->sendResponse($lokasi->toArray(), 'lokasi updated successfully');
    }

    /**
     * Remove the specified lokasi from storage.
     * DELETE /lokasis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var lokasi $lokasi */
        $lokasi = $this->lokasiRepository->find($id);

        if (empty($lokasi)) {
            return $this->sendError('Lokasi not found');
        }

        $lokasi->delete();

        return $this->sendResponse($id, 'Lokasi deleted successfully');
    }
}
