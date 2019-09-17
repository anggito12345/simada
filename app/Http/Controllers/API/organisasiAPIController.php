<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateorganisasiAPIRequest;
use App\Http\Requests\API\UpdateorganisasiAPIRequest;
use App\Models\organisasi;
use App\Repositories\organisasiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class organisasiController
 * @package App\Http\Controllers\API
 */

class organisasiAPIController extends AppBaseController
{
    /** @var  organisasiRepository */
    private $organisasiRepository;

    public function __construct(organisasiRepository $organisasiRepo)
    {
        $this->organisasiRepository = $organisasiRepo;
    }

    /**
     * Display a listing of the organisasi.
     * GET|HEAD /organisasis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $organisasis = \App\Models\organisasi::select([
            'nama as text',
            'id'
        ])
        ->whereRaw("nama like '%".$request->input("q")."%'")
        ->limit(10)
        ->get();

        return $this->sendResponse($organisasis->toArray(), 'Organisasis retrieved successfully');
    }

    /**
     * Store a newly created organisasi in storage.
     * POST /organisasis
     *
     * @param CreateorganisasiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateorganisasiAPIRequest $request)
    {
        $input = $request->all();

        $organisasi = $this->organisasiRepository->create($input);

        return $this->sendResponse($organisasi->toArray(), 'Organisasi saved successfully');
    }

    /**
     * Display the specified organisasi.
     * GET|HEAD /organisasis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var organisasi $organisasi */
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            return $this->sendError('Organisasi not found');
        }

        return $this->sendResponse($organisasi->toArray(), 'Organisasi retrieved successfully');
    }

    /**
     * Update the specified organisasi in storage.
     * PUT/PATCH /organisasis/{id}
     *
     * @param int $id
     * @param UpdateorganisasiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateorganisasiAPIRequest $request)
    {
        $input = $request->all();

        /** @var organisasi $organisasi */
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            return $this->sendError('Organisasi not found');
        }

        $organisasi = $this->organisasiRepository->update($input, $id);

        return $this->sendResponse($organisasi->toArray(), 'organisasi updated successfully');
    }

    /**
     * Remove the specified organisasi from storage.
     * DELETE /organisasis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var organisasi $organisasi */
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            return $this->sendError('Organisasi not found');
        }

        $organisasi->delete();

        return $this->sendResponse($id, 'Organisasi deleted successfully');
    }
}
