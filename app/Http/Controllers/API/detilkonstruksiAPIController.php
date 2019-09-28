<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedetilkonstruksiAPIRequest;
use App\Http\Requests\API\UpdatedetilkonstruksiAPIRequest;
use App\Models\detilkonstruksi;
use App\Repositories\detilkonstruksiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class detilkonstruksiController
 * @package App\Http\Controllers\API
 */

class detilkonstruksiAPIController extends AppBaseController
{
    /** @var  detilkonstruksiRepository */
    private $detilkonstruksiRepository;

    public function __construct(detilkonstruksiRepository $detilkonstruksiRepo)
    {
        $this->detilkonstruksiRepository = $detilkonstruksiRepo;
    }

    /**
     * Display a list detilkonstruksi by pidinventaris.
     * GET|HEAD /detilkibfsget
     *
     * @param Request $request
     * @return Response
     */
    public function byinventaris($pidinvetaris)
    {

        $detilkonstruksis = \App\Models\detilkonstruksi::where(['pidinventaris' => $pidinvetaris])->first();

        return $this->sendResponse($detilkonstruksis, 'Detilkonstruksis retrieved successfully');
    }

    /**
     * Display a listing of the detilkonstruksi.
     * GET|HEAD /detilkonstruksis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $detilkonstruksis = $this->detilkonstruksiRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($detilkonstruksis->toArray(), 'Detilkonstruksis retrieved successfully');
    }

    /**
     * Store a newly created detilkonstruksi in storage.
     * POST /detilkonstruksis
     *
     * @param CreatedetilkonstruksiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedetilkonstruksiAPIRequest $request)
    {
        $input = $request->all();

        $detilkonstruksi = $this->detilkonstruksiRepository->create($input);

        return $this->sendResponse($detilkonstruksi->toArray(), 'Detilkonstruksi saved successfully');
    }

    /**
     * Display the specified detilkonstruksi.
     * GET|HEAD /detilkonstruksis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var detilkonstruksi $detilkonstruksi */
        $detilkonstruksi = $this->detilkonstruksiRepository->find($id);

        if (empty($detilkonstruksi)) {
            return $this->sendError('Detilkonstruksi not found');
        }

        return $this->sendResponse($detilkonstruksi->toArray(), 'Detilkonstruksi retrieved successfully');
    }

    /**
     * Update the specified detilkonstruksi in storage.
     * PUT/PATCH /detilkonstruksis/{id}
     *
     * @param int $id
     * @param UpdatedetilkonstruksiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetilkonstruksiAPIRequest $request)
    {
        $input = $request->all();

        /** @var detilkonstruksi $detilkonstruksi */
        $detilkonstruksi = $this->detilkonstruksiRepository->find($id);

        if (empty($detilkonstruksi)) {
            return $this->sendError('Detilkonstruksi not found');
        }

        $detilkonstruksi = $this->detilkonstruksiRepository->update($input, $id);

        return $this->sendResponse($detilkonstruksi->toArray(), 'detilkonstruksi updated successfully');
    }

    /**
     * Remove the specified detilkonstruksi from storage.
     * DELETE /detilkonstruksis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var detilkonstruksi $detilkonstruksi */
        $detilkonstruksi = $this->detilkonstruksiRepository->find($id);

        if (empty($detilkonstruksi)) {
            return $this->sendError('Detilkonstruksi not found');
        }

        $detilkonstruksi->delete();

        return $this->sendResponse($id, 'Detilkonstruksi deleted successfully');
    }
}
