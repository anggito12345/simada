<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepenghapusanAPIRequest;
use App\Http\Requests\API\UpdatepenghapusanAPIRequest;
use App\Models\penghapusan;
use App\Repositories\penghapusanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class penghapusanController
 * @package App\Http\Controllers\API
 */

class penghapusanAPIController extends AppBaseController
{
    /** @var  penghapusanRepository */
    private $penghapusanRepository;

    public function __construct(penghapusanRepository $penghapusanRepo)
    {
        $this->penghapusanRepository = $penghapusanRepo;
    }

    /**
     * Display a listing of the penghapusan.
     * GET|HEAD /penghapusans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $penghapusans = $this->penghapusanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($penghapusans->toArray(), 'Penghapusans retrieved successfully');
    }

    /**
     * Store a newly created penghapusan in storage.
     * POST /penghapusans
     *
     * @param CreatepenghapusanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepenghapusanAPIRequest $request)
    {
        $input = $request->all();

        $penghapusan = $this->penghapusanRepository->create($input);

        return $this->sendResponse($penghapusan->toArray(), 'Penghapusan saved successfully');
    }

    /**
     * Display the specified penghapusan.
     * GET|HEAD /penghapusans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var penghapusan $penghapusan */
        $penghapusan = $this->penghapusanRepository->find($id);

        if (empty($penghapusan)) {
            return $this->sendError('Penghapusan not found');
        }

        return $this->sendResponse($penghapusan->toArray(), 'Penghapusan retrieved successfully');
    }

    /**
     * Update the specified penghapusan in storage.
     * PUT/PATCH /penghapusans/{id}
     *
     * @param int $id
     * @param UpdatepenghapusanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepenghapusanAPIRequest $request)
    {
        $input = $request->all();

        /** @var penghapusan $penghapusan */
        $penghapusan = $this->penghapusanRepository->find($id);

        if (empty($penghapusan)) {
            return $this->sendError('Penghapusan not found');
        }

        $penghapusan = $this->penghapusanRepository->update($input, $id);

        return $this->sendResponse($penghapusan->toArray(), 'penghapusan updated successfully');
    }

    /**
     * Remove the specified penghapusan from storage.
     * DELETE /penghapusans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var penghapusan $penghapusan */
        $penghapusan = $this->penghapusanRepository->find($id);

        if (empty($penghapusan)) {
            return $this->sendError('Penghapusan not found');
        }

        $penghapusan->delete();

        return $this->sendResponse($id, 'Penghapusan deleted successfully');
    }
}
