<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatekondisiAPIRequest;
use App\Http\Requests\API\UpdatekondisiAPIRequest;
use App\Models\kondisi;
use App\Repositories\kondisiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class kondisiController
 * @package App\Http\Controllers\API
 */

class kondisiAPIController extends AppBaseController
{
    /** @var  kondisiRepository */
    private $kondisiRepository;

    public function __construct(kondisiRepository $kondisiRepo)
    {
        $this->kondisiRepository = $kondisiRepo;
    }

    /**
     * Display a listing of the kondisi.
     * GET|HEAD /kondisis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $kondisis = $this->kondisiRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($kondisis->toArray(), 'Kondisis retrieved successfully');
    }

    /**
     * Store a newly created kondisi in storage.
     * POST /kondisis
     *
     * @param CreatekondisiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatekondisiAPIRequest $request)
    {
        $input = $request->all();

        $kondisi = $this->kondisiRepository->create($input);

        return $this->sendResponse($kondisi->toArray(), 'Kondisi saved successfully');
    }

    /**
     * Display the specified kondisi.
     * GET|HEAD /kondisis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var kondisi $kondisi */
        $kondisi = $this->kondisiRepository->find($id);

        if (empty($kondisi)) {
            return $this->sendError('Kondisi not found');
        }

        return $this->sendResponse($kondisi->toArray(), 'Kondisi retrieved successfully');
    }

    /**
     * Update the specified kondisi in storage.
     * PUT/PATCH /kondisis/{id}
     *
     * @param int $id
     * @param UpdatekondisiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatekondisiAPIRequest $request)
    {
        $input = $request->all();

        /** @var kondisi $kondisi */
        $kondisi = $this->kondisiRepository->find($id);

        if (empty($kondisi)) {
            return $this->sendError('Kondisi not found');
        }

        $kondisi = $this->kondisiRepository->update($input, $id);

        return $this->sendResponse($kondisi->toArray(), 'kondisi updated successfully');
    }

    /**
     * Remove the specified kondisi from storage.
     * DELETE /kondisis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var kondisi $kondisi */
        $kondisi = $this->kondisiRepository->find($id);

        if (empty($kondisi)) {
            return $this->sendError('Kondisi not found');
        }

        $kondisi->delete();

        return $this->sendResponse($id, 'Kondisi deleted successfully');
    }
}
