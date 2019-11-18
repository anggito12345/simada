<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createmodule_accessAPIRequest;
use App\Http\Requests\API\Updatemodule_accessAPIRequest;
use App\Models\module_access;
use App\Repositories\module_accessRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class module_accessController
 * @package App\Http\Controllers\API
 */

class module_accessAPIController extends AppBaseController
{
    /** @var  module_accessRepository */
    private $moduleAccessRepository;

    public function __construct(module_accessRepository $moduleAccessRepo)
    {
        $this->moduleAccessRepository = $moduleAccessRepo;
    }

    /**
     * Display a listing of the module_access.
     * GET|HEAD /moduleAccesses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $moduleAccesses = $this->moduleAccessRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($moduleAccesses->toArray(), 'Module Accesses retrieved successfully');
    }

    /**
     * Store a newly created module_access in storage.
     * POST /moduleAccesses
     *
     * @param Createmodule_accessAPIRequest $request
     *
     * @return Response
     */
    public function store(Createmodule_accessAPIRequest $request)
    {
        $input = $request->all();

        $moduleAccess = $this->moduleAccessRepository->create($input);

        return $this->sendResponse($moduleAccess->toArray(), 'Module Access saved successfully');
    }

    /**
     * Display the specified module_access.
     * GET|HEAD /moduleAccesses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var module_access $moduleAccess */
        $moduleAccess = $this->moduleAccessRepository->find($id);

        if (empty($moduleAccess)) {
            return $this->sendError('Module Access not found');
        }

        return $this->sendResponse($moduleAccess->toArray(), 'Module Access retrieved successfully');
    }

    /**
     * Update the specified module_access in storage.
     * PUT/PATCH /moduleAccesses/{id}
     *
     * @param int $id
     * @param Updatemodule_accessAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemodule_accessAPIRequest $request)
    {
        $input = $request->all();

        /** @var module_access $moduleAccess */
        $moduleAccess = $this->moduleAccessRepository->find($id);

        if (empty($moduleAccess)) {
            return $this->sendError('Module Access not found');
        }

        $moduleAccess = $this->moduleAccessRepository->update($input, $id);

        return $this->sendResponse($moduleAccess->toArray(), 'module_access updated successfully');
    }

    /**
     * Remove the specified module_access from storage.
     * DELETE /moduleAccesses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var module_access $moduleAccess */
        $moduleAccess = $this->moduleAccessRepository->find($id);

        if (empty($moduleAccess)) {
            return $this->sendError('Module Access not found');
        }

        $moduleAccess->delete();

        return $this->sendResponse($id, 'Module Access deleted successfully');
    }
}
