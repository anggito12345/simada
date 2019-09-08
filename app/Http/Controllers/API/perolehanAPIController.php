<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateperolehanAPIRequest;
use App\Http\Requests\API\UpdateperolehanAPIRequest;
use App\Models\perolehan;
use App\Repositories\perolehanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class perolehanController
 * @package App\Http\Controllers\API
 */

class perolehanAPIController extends AppBaseController
{
    /** @var  perolehanRepository */
    private $perolehanRepository;

    public function __construct(perolehanRepository $perolehanRepo)
    {
        $this->perolehanRepository = $perolehanRepo;
    }

    /**
     * Display a listing of the perolehan.
     * GET|HEAD /perolehans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $perolehans = $this->perolehanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($perolehans->toArray(), 'Perolehans retrieved successfully');
    }

    /**
     * Store a newly created perolehan in storage.
     * POST /perolehans
     *
     * @param CreateperolehanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateperolehanAPIRequest $request)
    {
        $input = $request->all();

        $perolehan = $this->perolehanRepository->create($input);

        return $this->sendResponse($perolehan->toArray(), 'Perolehan saved successfully');
    }

    /**
     * Display the specified perolehan.
     * GET|HEAD /perolehans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var perolehan $perolehan */
        $perolehan = $this->perolehanRepository->find($id);

        if (empty($perolehan)) {
            return $this->sendError('Perolehan not found');
        }

        return $this->sendResponse($perolehan->toArray(), 'Perolehan retrieved successfully');
    }

    /**
     * Update the specified perolehan in storage.
     * PUT/PATCH /perolehans/{id}
     *
     * @param int $id
     * @param UpdateperolehanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateperolehanAPIRequest $request)
    {
        $input = $request->all();

        /** @var perolehan $perolehan */
        $perolehan = $this->perolehanRepository->find($id);

        if (empty($perolehan)) {
            return $this->sendError('Perolehan not found');
        }

        $perolehan = $this->perolehanRepository->update($input, $id);

        return $this->sendResponse($perolehan->toArray(), 'perolehan updated successfully');
    }

    /**
     * Remove the specified perolehan from storage.
     * DELETE /perolehans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var perolehan $perolehan */
        $perolehan = $this->perolehanRepository->find($id);

        if (empty($perolehan)) {
            return $this->sendError('Perolehan not found');
        }

        $perolehan->delete();

        return $this->sendResponse($id, 'Perolehan deleted successfully');
    }
}
