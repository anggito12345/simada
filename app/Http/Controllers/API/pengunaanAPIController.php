<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepengunaanAPIRequest;
use App\Http\Requests\API\UpdatepengunaanAPIRequest;
use App\Models\pengunaan;
use App\Repositories\pengunaanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class pengunaanController
 * @package App\Http\Controllers\API
 */

class pengunaanAPIController extends AppBaseController
{
    /** @var  pengunaanRepository */
    private $pengunaanRepository;

    public function __construct(pengunaanRepository $pengunaanRepo)
    {
        $this->pengunaanRepository = $pengunaanRepo;
    }

    /**
     * Display a listing of the pengunaan.
     * GET|HEAD /pengunaans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $pengunaans = \App\Models\pengunaan::selectRaw(
            "nama as text, id
        ")
        ->whereRaw("nama ~* '".$request->input("term")."'")->get();

        return $this->sendResponse($pengunaans->toArray(), 'Pengunaans retrieved successfully');
    }

    /**
     * Store a newly created pengunaan in storage.
     * POST /pengunaans
     *
     * @param CreatepengunaanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepengunaanAPIRequest $request)
    {
        $input = $request->all();

        $pengunaan = $this->pengunaanRepository->create($input);

        return $this->sendResponse($pengunaan->toArray(), 'Pengunaan saved successfully');
    }

    /**
     * Display the specified pengunaan.
     * GET|HEAD /pengunaans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var pengunaan $pengunaan */
        $pengunaan = $this->pengunaanRepository->find($id);

        if (empty($pengunaan)) {
            return $this->sendError('Pengunaan not found');
        }

        return $this->sendResponse($pengunaan->toArray(), 'Pengunaan retrieved successfully');
    }

    /**
     * Update the specified pengunaan in storage.
     * PUT/PATCH /pengunaans/{id}
     *
     * @param int $id
     * @param UpdatepengunaanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepengunaanAPIRequest $request)
    {
        $input = $request->all();

        /** @var pengunaan $pengunaan */
        $pengunaan = $this->pengunaanRepository->find($id);

        if (empty($pengunaan)) {
            return $this->sendError('Pengunaan not found');
        }

        $pengunaan = $this->pengunaanRepository->update($input, $id);

        return $this->sendResponse($pengunaan->toArray(), 'pengunaan updated successfully');
    }

    /**
     * Remove the specified pengunaan from storage.
     * DELETE /pengunaans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var pengunaan $pengunaan */
        $pengunaan = $this->pengunaanRepository->find($id);

        if (empty($pengunaan)) {
            return $this->sendError('Pengunaan not found');
        }

        $pengunaan->delete();

        return $this->sendSuccess('Pengunaan deleted successfully');
    }
}
