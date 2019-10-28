<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemutasiAPIRequest;
use App\Http\Requests\API\UpdatemutasiAPIRequest;
use App\Models\mutasi;
use App\Repositories\mutasiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class mutasiController
 * @package App\Http\Controllers\API
 */

class mutasiAPIController extends AppBaseController
{
    /** @var  mutasiRepository */
    private $mutasiRepository;

    public function __construct(mutasiRepository $mutasiRepo)
    {
        $this->mutasiRepository = $mutasiRepo;
    }

    /**
     * Display a listing of the mutasi.
     * GET|HEAD /mutasis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $mutasis = $this->mutasiRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($mutasis->toArray(), 'Mutasis retrieved successfully');
    }

    /**
     * Store a newly created mutasi in storage.
     * POST /mutasis
     *
     * @param CreatemutasiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemutasiAPIRequest $request)
    {
        $input = $request->all();

        $mutasi = $this->mutasiRepository->create($input);

        return $this->sendResponse($mutasi->toArray(), 'Mutasi saved successfully');
    }

    /**
     * Display the specified mutasi.
     * GET|HEAD /mutasis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var mutasi $mutasi */
        $mutasi = $this->mutasiRepository->find($id);

        if (empty($mutasi)) {
            return $this->sendError('Mutasi not found');
        }

        return $this->sendResponse($mutasi->toArray(), 'Mutasi retrieved successfully');
    }

    /**
     * Update the specified mutasi in storage.
     * PUT/PATCH /mutasis/{id}
     *
     * @param int $id
     * @param UpdatemutasiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemutasiAPIRequest $request)
    {
        $input = $request->all();

        /** @var mutasi $mutasi */
        $mutasi = $this->mutasiRepository->find($id);

        if (empty($mutasi)) {
            return $this->sendError('Mutasi not found');
        }

        $mutasi = $this->mutasiRepository->update($input, $id);

        return $this->sendResponse($mutasi->toArray(), 'mutasi updated successfully');
    }

    /**
     * Remove the specified mutasi from storage.
     * DELETE /mutasis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var mutasi $mutasi */
        $mutasi = $this->mutasiRepository->find($id);

        if (empty($mutasi)) {
            return $this->sendError('Mutasi not found');
        }

        $mutasi->delete();

        return $this->sendResponse($id, 'Mutasi deleted successfully');
    }
}
