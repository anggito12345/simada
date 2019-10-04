<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepemeliharaanAPIRequest;
use App\Http\Requests\API\UpdatepemeliharaanAPIRequest;
use App\Models\pemeliharaan;
use App\Repositories\pemeliharaanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class pemeliharaanController
 * @package App\Http\Controllers\API
 */

class pemeliharaanAPIController extends AppBaseController
{
    /** @var  pemeliharaanRepository */
    private $pemeliharaanRepository;

    public function __construct(pemeliharaanRepository $pemeliharaanRepo)
    {
        $this->pemeliharaanRepository = $pemeliharaanRepo;
    }

    /**
     * Display a listing of the pemeliharaan.
     * GET|HEAD /pemeliharaans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $pemeliharaans = $this->pemeliharaanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($pemeliharaans->toArray(), 'Pemeliharaans retrieved successfully');
    }

    /**
     * Store a newly created pemeliharaan in storage.
     * POST /pemeliharaans
     *
     * @param CreatepemeliharaanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepemeliharaanAPIRequest $request)
    {
        $input = $request->all();

        $pemeliharaan = $this->pemeliharaanRepository->create($input);

        return $this->sendResponse($pemeliharaan->toArray(), 'Pemeliharaan saved successfully');
    }

    /**
     * Display the specified pemeliharaan.
     * GET|HEAD /pemeliharaans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var pemeliharaan $pemeliharaan */
        $pemeliharaan = $this->pemeliharaanRepository->find($id);

        if (empty($pemeliharaan)) {
            return $this->sendError('Pemeliharaan not found');
        }

        return $this->sendResponse($pemeliharaan->toArray(), 'Pemeliharaan retrieved successfully');
    }

    /**
     * Update the specified pemeliharaan in storage.
     * PUT/PATCH /pemeliharaans/{id}
     *
     * @param int $id
     * @param UpdatepemeliharaanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepemeliharaanAPIRequest $request)
    {
        $input = $request->all();

        /** @var pemeliharaan $pemeliharaan */
        $pemeliharaan = $this->pemeliharaanRepository->find($id);

        if (empty($pemeliharaan)) {
            return $this->sendError('Pemeliharaan not found');
        }

        $pemeliharaan = $this->pemeliharaanRepository->update($input, $id);

        return $this->sendResponse($pemeliharaan->toArray(), 'pemeliharaan updated successfully');
    }

    /**
     * Remove the specified pemeliharaan from storage.
     * DELETE /pemeliharaans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var pemeliharaan $pemeliharaan */
        $pemeliharaan = $this->pemeliharaanRepository->find($id);

        if (empty($pemeliharaan)) {
            return $this->sendError('Pemeliharaan not found');
        }

        $pemeliharaan->delete();

        return $this->sendResponse($id, 'Pemeliharaan deleted successfully');
    }
}
