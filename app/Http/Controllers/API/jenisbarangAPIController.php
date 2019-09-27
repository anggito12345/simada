<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatejenisbarangAPIRequest;
use App\Http\Requests\API\UpdatejenisbarangAPIRequest;
use App\Models\jenisbarang;
use App\Repositories\jenisbarangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class jenisbarangController
 * @package App\Http\Controllers\API
 */

class jenisbarangAPIController extends AppBaseController
{
    /** @var  jenisbarangRepository */
    private $jenisbarangRepository;

    public function __construct(jenisbarangRepository $jenisbarangRepo)
    {
        $this->jenisbarangRepository = $jenisbarangRepo;
    }

    /**
     * Display a listing of the jenisbarang.
     * GET|HEAD /jenisbarangs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $jenisbarangs = $this->jenisbarangRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($jenisbarangs->toArray(), 'Jenisbarangs retrieved successfully');
    }

    /**
     * Store a newly created jenisbarang in storage.
     * POST /jenisbarangs
     *
     * @param CreatejenisbarangAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatejenisbarangAPIRequest $request)
    {
        $input = $request->all();

        $jenisbarang = $this->jenisbarangRepository->create($input);

        return $this->sendResponse($jenisbarang->toArray(), 'Jenisbarang saved successfully');
    }


    /**
     * Display the specified jenisbarang.
     * GET|HEAD /jenisbarangsget/getbykode/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function getbykode($id)
    {
        /** @var jenisbarang $jenisbarang */
        $jenisbarang = \App\models\jenisbarang::where('kode', $id)->first();

        if (empty($jenisbarang)) {
            return $this->sendError('Jenisbarang not found');
        }

        return $this->sendResponse($jenisbarang->toArray(), 'Jenisbarang retrieved successfully');
    }

    /**
     * Display the specified jenisbarang.
     * GET|HEAD /jenisbarangs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var jenisbarang $jenisbarang */
        $jenisbarang = $this->jenisbarangRepository->find($id);

        if (empty($jenisbarang)) {
            return $this->sendError('Jenisbarang not found');
        }

        return $this->sendResponse($jenisbarang->toArray(), 'Jenisbarang retrieved successfully');
    }

    /**
     * Update the specified jenisbarang in storage.
     * PUT/PATCH /jenisbarangs/{id}
     *
     * @param int $id
     * @param UpdatejenisbarangAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatejenisbarangAPIRequest $request)
    {
        $input = $request->all();

        /** @var jenisbarang $jenisbarang */
        $jenisbarang = $this->jenisbarangRepository->find($id);

        if (empty($jenisbarang)) {
            return $this->sendError('Jenisbarang not found');
        }

        $jenisbarang = $this->jenisbarangRepository->update($input, $id);

        return $this->sendResponse($jenisbarang->toArray(), 'jenisbarang updated successfully');
    }

    /**
     * Remove the specified jenisbarang from storage.
     * DELETE /jenisbarangs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var jenisbarang $jenisbarang */
        $jenisbarang = $this->jenisbarangRepository->find($id);

        if (empty($jenisbarang)) {
            return $this->sendError('Jenisbarang not found');
        }

        $jenisbarang->delete();

        return $this->sendResponse($id, 'Jenisbarang deleted successfully');
    }
}
