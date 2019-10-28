<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createmutasi_detilAPIRequest;
use App\Http\Requests\API\Updatemutasi_detilAPIRequest;
use App\Models\mutasi_detil;
use App\Repositories\mutasi_detilRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class mutasi_detilController
 * @package App\Http\Controllers\API
 */

class mutasi_detilAPIController extends AppBaseController
{
    /** @var  mutasi_detilRepository */
    private $mutasiDetilRepository;

    public function __construct(mutasi_detilRepository $mutasiDetilRepo)
    {
        $this->mutasiDetilRepository = $mutasiDetilRepo;
    }

    /**
     * Display a listing of the mutasi_detil.
     * GET|HEAD /mutasiDetils
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $mutasiDetils = $this->mutasiDetilRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($mutasiDetils->toArray(), 'Mutasi Detils retrieved successfully');
    }

    /**
     * Store a newly created mutasi_detil in storage.
     * POST /mutasiDetils
     *
     * @param Createmutasi_detilAPIRequest $request
     *
     * @return Response
     */
    public function store(Createmutasi_detilAPIRequest $request)
    {
        $input = $request->all();

        $mutasiDetil = $this->mutasiDetilRepository->create($input);

        return $this->sendResponse($mutasiDetil->toArray(), 'Mutasi Detil saved successfully');
    }

    /**
     * Display the specified mutasi_detil.
     * GET|HEAD /mutasiDetils/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var mutasi_detil $mutasiDetil */
        $mutasiDetil = $this->mutasiDetilRepository->find($id);

        if (empty($mutasiDetil)) {
            return $this->sendError('Mutasi Detil not found');
        }

        return $this->sendResponse($mutasiDetil->toArray(), 'Mutasi Detil retrieved successfully');
    }

    /**
     * Update the specified mutasi_detil in storage.
     * PUT/PATCH /mutasiDetils/{id}
     *
     * @param int $id
     * @param Updatemutasi_detilAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemutasi_detilAPIRequest $request)
    {
        $input = $request->all();

        /** @var mutasi_detil $mutasiDetil */
        $mutasiDetil = $this->mutasiDetilRepository->find($id);

        if (empty($mutasiDetil)) {
            return $this->sendError('Mutasi Detil not found');
        }

        $mutasiDetil = $this->mutasiDetilRepository->update($input, $id);

        return $this->sendResponse($mutasiDetil->toArray(), 'mutasi_detil updated successfully');
    }

    /**
     * Remove the specified mutasi_detil from storage.
     * DELETE /mutasiDetils/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var mutasi_detil $mutasiDetil */
        $mutasiDetil = $this->mutasiDetilRepository->find($id);

        if (empty($mutasiDetil)) {
            return $this->sendError('Mutasi Detil not found');
        }

        $mutasiDetil->delete();

        return $this->sendResponse($id, 'Mutasi Detil deleted successfully');
    }
}
