<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemodulesAPIRequest;
use App\Http\Requests\API\UpdatemodulesAPIRequest;
use App\Models\modules;
use App\Repositories\modulesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class modulesController
 * @package App\Http\Controllers\API
 */

class modulesAPIController extends AppBaseController
{
    /** @var  modulesRepository */
    private $modulesRepository;

    public function __construct(modulesRepository $modulesRepo)
    {
        $this->modulesRepository = $modulesRepo;
    }

    /**
     * Display a listing of the modules.
     * GET|HEAD /modules
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $modules = $this->modulesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($modules->toArray(), 'Modules retrieved successfully');
    }

    /**
     * Store a newly created modules in storage.
     * POST /modules
     *
     * @param CreatemodulesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemodulesAPIRequest $request)
    {
        $input = $request->all();

        $modules = $this->modulesRepository->create($input);

        return $this->sendResponse($modules->toArray(), 'Modules saved successfully');
    }

    /**
     * Display the specified modules.
     * GET|HEAD /modules/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var modules $modules */
        $modules = $this->modulesRepository->find($id);

        if (empty($modules)) {
            return $this->sendError('Modules not found');
        }

        return $this->sendResponse($modules->toArray(), 'Modules retrieved successfully');
    }

    /**
     * Update the specified modules in storage.
     * PUT/PATCH /modules/{id}
     *
     * @param int $id
     * @param UpdatemodulesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemodulesAPIRequest $request)
    {
        $input = $request->all();

        /** @var modules $modules */
        $modules = $this->modulesRepository->find($id);

        if (empty($modules)) {
            return $this->sendError('Modules not found');
        }

        $modules = $this->modulesRepository->update($input, $id);

        return $this->sendResponse($modules->toArray(), 'modules updated successfully');
    }

    /**
     * Remove the specified modules from storage.
     * DELETE /modules/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var modules $modules */
        $modules = $this->modulesRepository->find($id);

        if (empty($modules)) {
            return $this->sendError('Modules not found');
        }

        $modules->delete();

        return $this->sendResponse($id, 'Modules deleted successfully');
    }
}
