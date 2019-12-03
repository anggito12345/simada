<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createinventaris_historyAPIRequest;
use App\Http\Requests\API\Updateinventaris_historyAPIRequest;
use App\Models\inventaris_history;
use App\Repositories\inventaris_historyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class inventaris_historyController
 * @package App\Http\Controllers\API
 */

class inventaris_historyAPIController extends AppBaseController
{
    /** @var  inventaris_historyRepository */
    private $inventarisHistoryRepository;

    public function __construct(inventaris_historyRepository $inventarisHistoryRepo)
    {
        $this->inventarisHistoryRepository = $inventarisHistoryRepo;
    }

    /**
     * Display a listing of the inventaris_history.
     * GET|HEAD /inventarisHistories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $inventarisHistories = $this->inventarisHistoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($inventarisHistories->toArray(), 'Inventaris Histories retrieved successfully');
    }

    /**
     * Store a newly created inventaris_history in storage.
     * POST /inventarisHistories
     *
     * @param Createinventaris_historyAPIRequest $request
     *
     * @return Response
     */
    public function store(Createinventaris_historyAPIRequest $request)
    {
        $input = $request->all();

        $inventarisHistory = $this->inventarisHistoryRepository->create($input);

        return $this->sendResponse($inventarisHistory->toArray(), 'Inventaris History saved successfully');
    }

    /**
     * Display the specified inventaris_history.
     * GET|HEAD /inventarisHistories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var inventaris_history $inventarisHistory */
        $inventarisHistory = $this->inventarisHistoryRepository->find($id);

        if (empty($inventarisHistory)) {
            return $this->sendError('Inventaris History not found');
        }

        return $this->sendResponse($inventarisHistory->toArray(), 'Inventaris History retrieved successfully');
    }

    /**
     * Update the specified inventaris_history in storage.
     * PUT/PATCH /inventarisHistories/{id}
     *
     * @param int $id
     * @param Updateinventaris_historyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateinventaris_historyAPIRequest $request)
    {
        $input = $request->all();

        /** @var inventaris_history $inventarisHistory */
        $inventarisHistory = $this->inventarisHistoryRepository->find($id);

        if (empty($inventarisHistory)) {
            return $this->sendError('Inventaris History not found');
        }

        $inventarisHistory = $this->inventarisHistoryRepository->update($input, $id);

        return $this->sendResponse($inventarisHistory->toArray(), 'inventaris_history updated successfully');
    }

    /**
     * Remove the specified inventaris_history from storage.
     * DELETE /inventarisHistories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var inventaris_history $inventarisHistory */
        $inventarisHistory = $this->inventarisHistoryRepository->find($id);

        if (empty($inventarisHistory)) {
            return $this->sendError('Inventaris History not found');
        }

        $inventarisHistory->delete();

        return $this->sendSuccess('Inventaris History deleted successfully');
    }
}
