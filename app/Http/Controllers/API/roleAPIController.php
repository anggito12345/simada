<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateroleAPIRequest;
use App\Http\Requests\API\UpdateroleAPIRequest;
use App\Models\role;
use App\Repositories\roleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class roleController
 * @package App\Http\Controllers\API
 */

class roleAPIController extends AppBaseController
{
    /** @var  roleRepository */
    private $roleRepository;

    public function __construct(roleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the role.
     * GET|HEAD /roles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($roles->toArray(), 'Roles retrieved successfully');
    }

    /**
     * Store a newly created role in storage.
     * POST /roles
     *
     * @param CreateroleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateroleAPIRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);

        return $this->sendResponse($role->toArray(), 'Role saved successfully');
    }

    /**
     * Display the specified role.
     * GET|HEAD /roles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var role $role */
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            return $this->sendError('Role not found');
        }

        return $this->sendResponse($role->toArray(), 'Role retrieved successfully');
    }

    /**
     * Update the specified role in storage.
     * PUT/PATCH /roles/{id}
     *
     * @param int $id
     * @param UpdateroleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateroleAPIRequest $request)
    {
        $input = $request->all();

        /** @var role $role */
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            return $this->sendError('Role not found');
        }

        $role = $this->roleRepository->update($input, $id);

        return $this->sendResponse($role->toArray(), 'role updated successfully');
    }

    /**
     * Remove the specified role from storage.
     * DELETE /roles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var role $role */
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            return $this->sendError('Role not found');
        }

        $role->delete();

        return $this->sendResponse($id, 'Role deleted successfully');
    }
}
