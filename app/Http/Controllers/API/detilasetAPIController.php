<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedetilasetAPIRequest;
use App\Http\Requests\API\UpdatedetilasetAPIRequest;
use App\Models\detilaset;
use App\Repositories\detilasetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class detilasetController
 * @package App\Http\Controllers\API
 */

class detilasetAPIController extends AppBaseController
{
    /** @var  detilasetRepository */
    private $detilasetRepository;

    public function __construct(detilasetRepository $detilasetRepo)
    {
        $this->detilasetRepository = $detilasetRepo;
    }

    /**
     * Display a list detilaset by pidinventaris.
     * GET|HEAD /detilkibesget
     *
     * @param Request $request
     * @return Response
     */
    public function byinventaris($pidinvetaris)
    {

        $detilasets = \App\Models\detilaset::where(['pidinventaris' => $pidinvetaris])->first();

        return $this->sendResponse($detilasets, 'Detilasets retrieved successfully');
    }

    /**
     * Display a listing of the detilaset.
     * GET|HEAD /detilasets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $detilasets = $this->detilasetRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($detilasets->toArray(), 'Detilasets retrieved successfully');
    }

    /**
     * Store a newly created detilaset in storage.
     * POST /detilasets
     *
     * @param CreatedetilasetAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedetilasetAPIRequest $request)
    {
        $input = $request->all();

        $detilaset = $this->detilasetRepository->create($input);

        return $this->sendResponse($detilaset->toArray(), 'Detilaset saved successfully');
    }

    /**
     * Display the specified detilaset.
     * GET|HEAD /detilasets/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var detilaset $detilaset */
        $detilaset = $this->detilasetRepository->find($id);

        if (empty($detilaset)) {
            return $this->sendError('Detilaset not found');
        }

        return $this->sendResponse($detilaset->toArray(), 'Detilaset retrieved successfully');
    }

    /**
     * Update the specified detilaset in storage.
     * PUT/PATCH /detilasets/{id}
     *
     * @param int $id
     * @param UpdatedetilasetAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetilasetAPIRequest $request)
    {
        $input = $request->all();

        /** @var detilaset $detilaset */
        $detilaset = $this->detilasetRepository->find($id);

        if (empty($detilaset)) {
            return $this->sendError('Detilaset not found');
        }

        $detilaset = $this->detilasetRepository->update($input, $id);

        return $this->sendResponse($detilaset->toArray(), 'detilaset updated successfully');
    }

    /**
     * Remove the specified detilaset from storage.
     * DELETE /detilasets/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var detilaset $detilaset */
        $detilaset = $this->detilasetRepository->find($id);

        if (empty($detilaset)) {
            return $this->sendError('Detilaset not found');
        }

        $detilaset->delete();

        return $this->sendResponse($id, 'Detilaset deleted successfully');
    }
}
