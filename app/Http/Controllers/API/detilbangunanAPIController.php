<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedetilbangunanAPIRequest;
use App\Http\Requests\API\UpdatedetilbangunanAPIRequest;
use App\Models\detilbangunan;
use App\Repositories\detilbangunanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class detilbangunanController
 * @package App\Http\Controllers\API
 */

class detilbangunanAPIController extends AppBaseController
{
    /** @var  detilbangunanRepository */
    private $detilbangunanRepository;

    public function __construct(detilbangunanRepository $detilbangunanRepo)
    {
        $this->detilbangunanRepository = $detilbangunanRepo;
    }

    /**
     * Display a listing of the detilbangunan.
     * GET|HEAD /detilbangunans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $detilbangunans = $this->detilbangunanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($detilbangunans->toArray(), 'Detilbangunans retrieved successfully');
    }

    /**
     * Store a newly created detilbangunan in storage.
     * POST /detilbangunans
     *
     * @param CreatedetilbangunanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedetilbangunanAPIRequest $request)
    {
        $input = $request->all();

        $detilbangunan = $this->detilbangunanRepository->create($input);

        return $this->sendResponse($detilbangunan->toArray(), 'Detilbangunan saved successfully');
    }

    /**
     * Display the specified detilbangunan.
     * GET|HEAD /detilbangunans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var detilbangunan $detilbangunan */
        $detilbangunan = $this->detilbangunanRepository->find($id);

        if (empty($detilbangunan)) {
            return $this->sendError('Detilbangunan not found');
        }

        return $this->sendResponse($detilbangunan->toArray(), 'Detilbangunan retrieved successfully');
    }

    /**
     * Update the specified detilbangunan in storage.
     * PUT/PATCH /detilbangunans/{id}
     *
     * @param int $id
     * @param UpdatedetilbangunanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetilbangunanAPIRequest $request)
    {
        $input = $request->all();

        /** @var detilbangunan $detilbangunan */
        $detilbangunan = $this->detilbangunanRepository->find($id);

        if (empty($detilbangunan)) {
            return $this->sendError('Detilbangunan not found');
        }

        $detilbangunan = $this->detilbangunanRepository->update($input, $id);

        return $this->sendResponse($detilbangunan->toArray(), 'detilbangunan updated successfully');
    }

    /**
     * Remove the specified detilbangunan from storage.
     * DELETE /detilbangunans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var detilbangunan $detilbangunan */
        $detilbangunan = $this->detilbangunanRepository->find($id);

        if (empty($detilbangunan)) {
            return $this->sendError('Detilbangunan not found');
        }

        $detilbangunan->delete();

        return $this->sendResponse($id, 'Detilbangunan deleted successfully');
    }
}
