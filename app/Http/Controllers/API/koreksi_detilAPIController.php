<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createkoreksi_detilAPIRequest;
use App\Http\Requests\API\Updatekoreksi_detilAPIRequest;
use App\Models\koreksi_detil;
use App\Repositories\koreksi_detilRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class koreksi_detilController
 * @package App\Http\Controllers\API
 */

class koreksi_detilAPIController extends AppBaseController
{
    /** @var  koreksi_detilRepository */
    private $koreksiDetilRepository;

    public function __construct(koreksi_detilRepository $koreksiDetilRepo)
    {
        $this->koreksiDetilRepository = $koreksiDetilRepo;
    }

    /**
     * Display a listing of the koreksi_detil.
     * GET|HEAD /koreksiDetils
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $koreksiDetils = $this->koreksiDetilRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($koreksiDetils->toArray(), 'Koreksi Detils retrieved successfully');
    }

    /**
     * Store a newly created koreksi_detil in storage.
     * POST /koreksiDetils
     *
     * @param Createkoreksi_detilAPIRequest $request
     *
     * @return Response
     */
    public function store(Createkoreksi_detilAPIRequest $request)
    {
        $input = $request->all();

        $koreksiDetil = $this->koreksiDetilRepository->create($input);

        return $this->sendResponse($koreksiDetil->toArray(), 'Koreksi Detil saved successfully');
    }

    /**
     * Display the specified koreksi_detil.
     * GET|HEAD /koreksiDetils/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var koreksi_detil $koreksiDetil */
        $koreksiDetil = $this->koreksiDetilRepository->find($id);

        if (empty($koreksiDetil)) {
            return $this->sendError('Koreksi Detil not found');
        }

        return $this->sendResponse($koreksiDetil->toArray(), 'Koreksi Detil retrieved successfully');
    }

    /**
     * Update the specified koreksi_detil in storage.
     * PUT/PATCH /koreksiDetils/{id}
     *
     * @param int $id
     * @param Updatekoreksi_detilAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatekoreksi_detilAPIRequest $request)
    {
        $input = $request->all();

        /** @var koreksi_detil $koreksiDetil */
        $koreksiDetil = $this->koreksiDetilRepository->find($id);

        if (empty($koreksiDetil)) {
            return $this->sendError('Koreksi Detil not found');
        }

        $koreksiDetil = $this->koreksiDetilRepository->update($input, $id);

        return $this->sendResponse($koreksiDetil->toArray(), 'koreksi_detil updated successfully');
    }

    /**
     * Remove the specified koreksi_detil from storage.
     * DELETE /koreksiDetils/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var koreksi_detil $koreksiDetil */
        $koreksiDetil = $this->koreksiDetilRepository->find($id);

        if (empty($koreksiDetil)) {
            return $this->sendError('Koreksi Detil not found');
        }

        $koreksiDetil->delete();

        return $this->sendSuccess('Koreksi Detil deleted successfully');
    }
}
