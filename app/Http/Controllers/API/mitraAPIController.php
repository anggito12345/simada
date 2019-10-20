<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemitraAPIRequest;
use App\Http\Requests\API\UpdatemitraAPIRequest;
use App\Models\mitra;
use App\Repositories\mitraRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class mitraController
 * @package App\Http\Controllers\API
 */

class mitraAPIController extends AppBaseController
{
    /** @var  mitraRepository */
    private $mitraRepository;

    public function __construct(mitraRepository $mitraRepo)
    {
        $this->mitraRepository = $mitraRepo;
    }

    /**
     * Display a listing of the mitra.
     * GET|HEAD /mitras
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $mitras = \App\Models\mitra::select([
            'nama as text',
            'id'
        ])
        ->whereRaw("nama like '%".$request->input("term")."%'")
        ->limit(10)
        ->get();


        return $this->sendResponse($mitras->toArray(), 'Mitras retrieved successfully');
    }

    /**
     * Store a newly created mitra in storage.
     * POST /mitras
     *
     * @param CreatemitraAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemitraAPIRequest $request)
    {
        $input = $request->all();

        $mitra = $this->mitraRepository->create($input);

        return $this->sendResponse($mitra->toArray(), 'Mitra saved successfully');
    }

    /**
     * Display the specified mitra.
     * GET|HEAD /mitras/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var mitra $mitra */
        $mitra = $this->mitraRepository->find($id);

        if (empty($mitra)) {
            return $this->sendError('Mitra not found');
        }

        return $this->sendResponse($mitra->toArray(), 'Mitra retrieved successfully');
    }

    /**
     * Update the specified mitra in storage.
     * PUT/PATCH /mitras/{id}
     *
     * @param int $id
     * @param UpdatemitraAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemitraAPIRequest $request)
    {
        $input = $request->all();

        /** @var mitra $mitra */
        $mitra = $this->mitraRepository->find($id);

        if (empty($mitra)) {
            return $this->sendError('Mitra not found');
        }

        $mitra = $this->mitraRepository->update($input, $id);

        return $this->sendResponse($mitra->toArray(), 'mitra updated successfully');
    }

    /**
     * Remove the specified mitra from storage.
     * DELETE /mitras/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var mitra $mitra */
        $mitra = $this->mitraRepository->find($id);

        if (empty($mitra)) {
            return $this->sendError('Mitra not found');
        }

        $mitra->delete();

        return $this->sendResponse($id, 'Mitra deleted successfully');
    }
}
