<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatejenisopdAPIRequest;
use App\Http\Requests\API\UpdatejenisopdAPIRequest;
use App\Models\jenisopd;
use App\Repositories\jenisopdRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class jenisopdController
 * @package App\Http\Controllers\API
 */

class jenisopdAPIController extends AppBaseController
{
    /** @var  jenisopdRepository */
    private $jenisopdRepository;

    public function __construct(jenisopdRepository $jenisopdRepo)
    {
        $this->jenisopdRepository = $jenisopdRepo;
    }

    /**
     * Display a listing of the jenisopd.
     * GET|HEAD /jenisopds
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $jenisopds = $this->jenisopdRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($jenisopds->toArray(), 'Jenisopds retrieved successfully');
    }

    /**
     * Store a newly created jenisopd in storage.
     * POST /jenisopds
     *
     * @param CreatejenisopdAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatejenisopdAPIRequest $request)
    {
        $input = $request->all();

        $jenisopd = $this->jenisopdRepository->create($input);

        return $this->sendResponse($jenisopd->toArray(), 'Jenisopd saved successfully');
    }

    /**
     * Display the specified jenisopd.
     * GET|HEAD /jenisopds/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var jenisopd $jenisopd */
        $jenisopd = $this->jenisopdRepository->find($id);

        if (empty($jenisopd)) {
            return $this->sendError('Jenisopd not found');
        }

        return $this->sendResponse($jenisopd->toArray(), 'Jenisopd retrieved successfully');
    }

    /**
     * Update the specified jenisopd in storage.
     * PUT/PATCH /jenisopds/{id}
     *
     * @param int $id
     * @param UpdatejenisopdAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatejenisopdAPIRequest $request)
    {
        $input = $request->all();

        /** @var jenisopd $jenisopd */
        $jenisopd = $this->jenisopdRepository->find($id);

        if (empty($jenisopd)) {
            return $this->sendError('Jenisopd not found');
        }

        $jenisopd = $this->jenisopdRepository->update($input, $id);

        return $this->sendResponse($jenisopd->toArray(), 'jenisopd updated successfully');
    }

    /**
     * Remove the specified jenisopd from storage.
     * DELETE /jenisopds/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var jenisopd $jenisopd */
        $jenisopd = $this->jenisopdRepository->find($id);

        if (empty($jenisopd)) {
            return $this->sendError('Jenisopd not found');
        }

        $jenisopd->delete();

        return $this->sendResponse($id, 'Jenisopd deleted successfully');
    }
}
