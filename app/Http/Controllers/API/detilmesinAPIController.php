<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedetilmesinAPIRequest;
use App\Http\Requests\API\UpdatedetilmesinAPIRequest;
use App\Models\detilmesin;
use App\Repositories\detilmesinRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class detilmesinController
 * @package App\Http\Controllers\API
 */

class detilmesinAPIController extends AppBaseController
{
    /** @var  detilmesinRepository */
    private $detilmesinRepository;

    public function __construct(detilmesinRepository $detilmesinRepo)
    {
        $this->detilmesinRepository = $detilmesinRepo;
    }

    /**
     * Display a listing of the detilmesin.
     * GET|HEAD /detilmesins
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $detilmesins = $this->detilmesinRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($detilmesins->toArray(), 'Detilmesins retrieved successfully');
    }

    /**
     * Store a newly created detilmesin in storage.
     * POST /detilmesins
     *
     * @param CreatedetilmesinAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedetilmesinAPIRequest $request)
    {
        $input = $request->all();

        $detilmesin = $this->detilmesinRepository->create($input);

        return $this->sendResponse($detilmesin->toArray(), 'Detilmesin saved successfully');
    }

    /**
     * Display the specified detilmesin.
     * GET|HEAD /detilmesins/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var detilmesin $detilmesin */
        $detilmesin = $this->detilmesinRepository->find($id);

        if (empty($detilmesin)) {
            return $this->sendError('Detilmesin not found');
        }

        return $this->sendResponse($detilmesin->toArray(), 'Detilmesin retrieved successfully');
    }

    /**
     * Update the specified detilmesin in storage.
     * PUT/PATCH /detilmesins/{id}
     *
     * @param int $id
     * @param UpdatedetilmesinAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetilmesinAPIRequest $request)
    {
        $input = $request->all();

        /** @var detilmesin $detilmesin */
        $detilmesin = $this->detilmesinRepository->find($id);

        if (empty($detilmesin)) {
            return $this->sendError('Detilmesin not found');
        }

        $detilmesin = $this->detilmesinRepository->update($input, $id);

        return $this->sendResponse($detilmesin->toArray(), 'detilmesin updated successfully');
    }

    /**
     * Remove the specified detilmesin from storage.
     * DELETE /detilmesins/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var detilmesin $detilmesin */
        $detilmesin = $this->detilmesinRepository->find($id);

        if (empty($detilmesin)) {
            return $this->sendError('Detilmesin not found');
        }

        $detilmesin->delete();

        return $this->sendResponse($id, 'Detilmesin deleted successfully');
    }
}
