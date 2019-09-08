<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedetiltanahAPIRequest;
use App\Http\Requests\API\UpdatedetiltanahAPIRequest;
use App\Models\detiltanah;
use App\Repositories\detiltanahRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

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
        $this->detiltanahRepository = $detiltanahRepo;
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
        $detiltanahs = $this->detiltanahRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

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
        $detiltanah = $this->detiltanahRepository->find($id);

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
