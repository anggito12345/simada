<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedetiljalanAPIRequest;
use App\Http\Requests\API\UpdatedetiljalanAPIRequest;
use App\Models\detiljalan;
use App\Repositories\detiljalanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class detiljalanController
 * @package App\Http\Controllers\API
 */

class detiljalanAPIController extends AppBaseController
{
    /** @var  detiljalanRepository */
    private $detiljalanRepository;

    public function __construct(detiljalanRepository $detiljalanRepo)
    {
        $this->detiljalanRepository = $detiljalanRepo;
    }

    /**
     * Display a listing of the detiljalan.
     * GET|HEAD /detiljalans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $detiljalans = $this->detiljalanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($detiljalans->toArray(), 'Detiljalans retrieved successfully');
    }

    /**
     * Store a newly created detiljalan in storage.
     * POST /detiljalans
     *
     * @param CreatedetiljalanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedetiljalanAPIRequest $request)
    {
        $input = $request->all();

        $detiljalan = $this->detiljalanRepository->create($input);

        return $this->sendResponse($detiljalan->toArray(), 'Detiljalan saved successfully');
    }

    /**
     * Display the specified detiljalan.
     * GET|HEAD /detiljalans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var detiljalan $detiljalan */
        $detiljalan = $this->detiljalanRepository->find($id);

        if (empty($detiljalan)) {
            return $this->sendError('Detiljalan not found');
        }

        return $this->sendResponse($detiljalan->toArray(), 'Detiljalan retrieved successfully');
    }

    /**
     * Update the specified detiljalan in storage.
     * PUT/PATCH /detiljalans/{id}
     *
     * @param int $id
     * @param UpdatedetiljalanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetiljalanAPIRequest $request)
    {
        $input = $request->all();

        /** @var detiljalan $detiljalan */
        $detiljalan = $this->detiljalanRepository->find($id);

        if (empty($detiljalan)) {
            return $this->sendError('Detiljalan not found');
        }

        $detiljalan = $this->detiljalanRepository->update($input, $id);

        return $this->sendResponse($detiljalan->toArray(), 'detiljalan updated successfully');
    }

    /**
     * Remove the specified detiljalan from storage.
     * DELETE /detiljalans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var detiljalan $detiljalan */
        $detiljalan = $this->detiljalanRepository->find($id);

        if (empty($detiljalan)) {
            return $this->sendError('Detiljalan not found');
        }

        $detiljalan->delete();

        return $this->sendResponse($id, 'Detiljalan deleted successfully');
    }
}
