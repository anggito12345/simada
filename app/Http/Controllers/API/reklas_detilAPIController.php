<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createreklas_detilAPIRequest;
use App\Http\Requests\API\Updatereklas_detilAPIRequest;
use App\Models\reklas_detil;
use App\Repositories\reklas_detilRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class reklas_detilController
 * @package App\Http\Controllers\API
 */

class reklas_detilAPIController extends AppBaseController
{
    /** @var  reklas_detilRepository */
    private $reklasDetilRepository;

    public function __construct(reklas_detilRepository $reklasDetilRepo)
    {
        $this->reklasDetilRepository = $reklasDetilRepo;
    }

    /**
     * Display a listing of the reklas_detil.
     * GET|HEAD /reklasDetils
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $reklasDetils = $this->reklasDetilRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($reklasDetils->toArray(), 'Reklas Detils retrieved successfully');
    }

    /**
     * Store a newly created reklas_detil in storage.
     * POST /reklasDetils
     *
     * @param Createreklas_detilAPIRequest $request
     *
     * @return Response
     */
    public function store(Createreklas_detilAPIRequest $request)
    {
        $input = $request->all();

        $reklasDetil = $this->reklasDetilRepository->create($input);

        return $this->sendResponse($reklasDetil->toArray(), 'Reklas Detil saved successfully');
    }

    /**
     * Display the specified reklas_detil.
     * GET|HEAD /reklasDetils/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var reklas_detil $reklasDetil */
        $reklasDetil = $this->reklasDetilRepository->find($id);

        if (empty($reklasDetil)) {
            return $this->sendError('Reklas Detil not found');
        }

        return $this->sendResponse($reklasDetil->toArray(), 'Reklas Detil retrieved successfully');
    }

    /**
     * Update the specified reklas_detil in storage.
     * PUT/PATCH /reklasDetils/{id}
     *
     * @param int $id
     * @param Updatereklas_detilAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatereklas_detilAPIRequest $request)
    {
        $input = $request->all();

        /** @var reklas_detil $reklasDetil */
        $reklasDetil = $this->reklasDetilRepository->find($id);

        if (empty($reklasDetil)) {
            return $this->sendError('Reklas Detil not found');
        }

        $reklasDetil = $this->reklasDetilRepository->update($input, $id);

        return $this->sendResponse($reklasDetil->toArray(), 'reklas_detil updated successfully');
    }

    /**
     * Remove the specified reklas_detil from storage.
     * DELETE /reklasDetils/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var reklas_detil $reklasDetil */
        $reklasDetil = $this->reklasDetilRepository->find($id);

        if (empty($reklasDetil)) {
            return $this->sendError('Reklas Detil not found');
        }

        $reklasDetil->delete();

        return $this->sendSuccess('Reklas Detil deleted successfully');
    }
}
