<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createinventaris_reklasAPIRequest;
use App\Http\Requests\API\Updateinventaris_reklasAPIRequest;
use App\Models\inventaris_reklas;
use App\Repositories\inventaris_reklasRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class inventaris_reklasController
 * @package App\Http\Controllers\API
 */

class inventaris_reklasAPIController extends AppBaseController
{
    /** @var  inventaris_reklasRepository */
    private $inventarisReklasRepository;

    public function __construct(inventaris_reklasRepository $inventarisReklasRepo)
    {
        $this->inventarisReklasRepository = $inventarisReklasRepo;
    }

    /**
     * Display a listing of the inventaris_reklas.
     * GET|HEAD /inventarisReklas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $inventarisReklas = $this->inventarisReklasRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($inventarisReklas->toArray(), 'Inventaris Reklas retrieved successfully');
    }

    /**
     * Store a newly created inventaris_reklas in storage.
     * POST /inventarisReklas
     *
     * @param Createinventaris_reklasAPIRequest $request
     *
     * @return Response
     */
    public function store(Createinventaris_reklasAPIRequest $request)
    {
        $input = $request->all();

        $inventarisReklas = $this->inventarisReklasRepository->create($input);

        return $this->sendResponse($inventarisReklas->toArray(), 'Inventaris Reklas saved successfully');
    }

    /**
     * Display the specified inventaris_reklas.
     * GET|HEAD /inventarisReklas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var inventaris_reklas $inventarisReklas */
        $inventarisReklas = $this->inventarisReklasRepository->find($id);

        if (empty($inventarisReklas)) {
            return $this->sendError('Inventaris Reklas not found');
        }

        return $this->sendResponse($inventarisReklas->toArray(), 'Inventaris Reklas retrieved successfully');
    }

    /**
     * Update the specified inventaris_reklas in storage.
     * PUT/PATCH /inventarisReklas/{id}
     *
     * @param int $id
     * @param Updateinventaris_reklasAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateinventaris_reklasAPIRequest $request)
    {
        $input = $request->all();

        /** @var inventaris_reklas $inventarisReklas */
        $inventarisReklas = $this->inventarisReklasRepository->find($id);

        if (empty($inventarisReklas)) {
            return $this->sendError('Inventaris Reklas not found');
        }

        $inventarisReklas = $this->inventarisReklasRepository->update($input, $id);

        return $this->sendResponse($inventarisReklas->toArray(), 'inventaris_reklas updated successfully');
    }

    /**
     * Remove the specified inventaris_reklas from storage.
     * DELETE /inventarisReklas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var inventaris_reklas $inventarisReklas */
        $inventarisReklas = $this->inventarisReklasRepository->find($id);

        if (empty($inventarisReklas)) {
            return $this->sendError('Inventaris Reklas not found');
        }

        $inventarisReklas->delete();

        return $this->sendSuccess('Inventaris Reklas deleted successfully');
    }
}
