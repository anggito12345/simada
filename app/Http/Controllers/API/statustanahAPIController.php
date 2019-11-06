<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatestatustanahAPIRequest;
use App\Http\Requests\API\UpdatestatustanahAPIRequest;
use App\Models\statustanah;
use App\Repositories\statustanahRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class statustanahController
 * @package App\Http\Controllers\API
 */

class statustanahAPIController extends AppBaseController
{
    /** @var  statustanahRepository */
    private $statustanahRepository;

    public function __construct(statustanahRepository $statustanahRepo)
    {
        $this->statustanahRepository = $statustanahRepo;
    }

    /**
     * Display a listing of the statustanah.
     * GET|HEAD /statustanahs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $statustanahs = \App\Models\statustanah::select([
            'nama as text',
            'id'
        ])
        ->whereRaw("nama like '%".$request->input("term")."%'")
         
        ->get();

        return $this->sendResponse($statustanahs->toArray(), 'Statustanahs retrieved successfully');
    }

    /**
     * Store a newly created statustanah in storage.
     * POST /statustanahs
     *
     * @param CreatestatustanahAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatestatustanahAPIRequest $request)
    {
        $input = $request->all();

        $statustanah = $this->statustanahRepository->create($input);

        return $this->sendResponse($statustanah->toArray(), 'Statustanah saved successfully');
    }

    /**
     * Display the specified statustanah.
     * GET|HEAD /statustanahs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var statustanah $statustanah */
        $statustanah = $this->statustanahRepository->find($id);

        if (empty($statustanah)) {
            return $this->sendError('Statustanah not found');
        }

        return $this->sendResponse($statustanah->toArray(), 'Statustanah retrieved successfully');
    }

    /**
     * Update the specified statustanah in storage.
     * PUT/PATCH /statustanahs/{id}
     *
     * @param int $id
     * @param UpdatestatustanahAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestatustanahAPIRequest $request)
    {
        $input = $request->all();

        /** @var statustanah $statustanah */
        $statustanah = $this->statustanahRepository->find($id);

        if (empty($statustanah)) {
            return $this->sendError('Statustanah not found');
        }

        $statustanah = $this->statustanahRepository->update($input, $id);

        return $this->sendResponse($statustanah->toArray(), 'statustanah updated successfully');
    }

    /**
     * Remove the specified statustanah from storage.
     * DELETE /statustanahs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var statustanah $statustanah */
        $statustanah = $this->statustanahRepository->find($id);

        if (empty($statustanah)) {
            return $this->sendError('Statustanah not found');
        }

        $statustanah->delete();

        return $this->sendResponse($id, 'Statustanah deleted successfully');
    }
}
