<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createrka_detilAPIRequest;
use App\Http\Requests\API\Updaterka_detilAPIRequest;
use App\Models\rka_detil;
use App\Repositories\rka_detilRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class rka_detilController
 * @package App\Http\Controllers\API
 */

class rka_detilAPIController extends AppBaseController
{
    /** @var  rka_detilRepository */
    private $rkaDetilRepository;

    public function __construct(rka_detilRepository $rkaDetilRepo)
    {
        $this->rkaDetilRepository = $rkaDetilRepo;
    }

    /**
     * Display a listing of the rka_detil.
     * GET|HEAD /rkaDetils
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $rkaDetils = $this->rkaDetilRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rkaDetils->toArray(), 'Rka Detils retrieved successfully');
    }

    /**
     * Store a newly created rka_detil in storage.
     * POST /rkaDetils
     *
     * @param Createrka_detilAPIRequest $request
     *
     * @return Response
     */
    public function store(Createrka_detilAPIRequest $request)
    {
        $input = $request->all();

        $rkaDetil = $this->rkaDetilRepository->create($input);

        return $this->sendResponse($rkaDetil->toArray(), 'Rka Detil saved successfully');
    }

    /**
     * Display the specified rka_detil.
     * GET|HEAD /rkaDetils/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var rka_detil $rkaDetil */
        $rkaDetil = $this->rkaDetilRepository->find($id);

        if (empty($rkaDetil)) {
            return $this->sendError('Rka Detil not found');
        }

        return $this->sendResponse($rkaDetil->toArray(), 'Rka Detil retrieved successfully');
    }

    /**
     * Update the specified rka_detil in storage.
     * PUT/PATCH /rkaDetils/{id}
     *
     * @param int $id
     * @param Updaterka_detilAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updaterka_detilAPIRequest $request)
    {
        $input = $request->all();

        /** @var rka_detil $rkaDetil */
        $rkaDetil = $this->rkaDetilRepository->find($id);

        if (empty($rkaDetil)) {
            return $this->sendError('Rka Detil not found');
        }

        $rkaDetil = $this->rkaDetilRepository->update($input, $id);

        return $this->sendResponse($rkaDetil->toArray(), 'rka_detil updated successfully');
    }

    /**
     * Remove the specified rka_detil from storage.
     * DELETE /rkaDetils/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var rka_detil $rkaDetil */
        $rkaDetil = $this->rkaDetilRepository->find($id);

        if (empty($rkaDetil)) {
            return $this->sendError('Rka Detil not found');
        }

        $rkaDetil->delete();

        return $this->sendResponse($id, 'Rka Detil deleted successfully');
    }
}
