<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatesatuanbarangAPIRequest;
use App\Http\Requests\API\UpdatesatuanbarangAPIRequest;
use App\Models\satuanbarang;
use App\Repositories\satuanbarangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class satuanbarangController
 * @package App\Http\Controllers\API
 */

class satuanbarangAPIController extends AppBaseController
{
    /** @var  satuanbarangRepository */
    private $satuanbarangRepository;

    public function __construct(satuanbarangRepository $satuanbarangRepo)
    {
        $this->satuanbarangRepository = $satuanbarangRepo;
    }

    /**
     * Display a listing of the satuanbarang.
     * GET|HEAD /satuanbarangs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $satuanbarangs = \App\Models\satuanbarang::select([
            'nama as text',
            'id'
        ])
        ->whereRaw("nama like '%".$request->input("term")."%'")
        ->limit(10)
        ->get();

        return $this->sendResponse($satuanbarangs->toArray(), 'Satuanbarangs retrieved successfully');
    }

    /**
     * Store a newly created satuanbarang in storage.
     * POST /satuanbarangs
     *
     * @param CreatesatuanbarangAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatesatuanbarangAPIRequest $request)
    {
        $input = $request->all();

        $satuanbarang = $this->satuanbarangRepository->create($input);

        return $this->sendResponse($satuanbarang->toArray(), 'Satuanbarang saved successfully');
    }

    /**
     * Display the specified satuanbarang.
     * GET|HEAD /satuanbarangs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var satuanbarang $satuanbarang */
        $satuanbarang = $this->satuanbarangRepository->find($id);

        if (empty($satuanbarang)) {
            return $this->sendError('Satuanbarang not found');
        }

        return $this->sendResponse($satuanbarang->toArray(), 'Satuanbarang retrieved successfully');
    }

    /**
     * Update the specified satuanbarang in storage.
     * PUT/PATCH /satuanbarangs/{id}
     *
     * @param int $id
     * @param UpdatesatuanbarangAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesatuanbarangAPIRequest $request)
    {
        $input = $request->all();

        /** @var satuanbarang $satuanbarang */
        $satuanbarang = $this->satuanbarangRepository->find($id);

        if (empty($satuanbarang)) {
            return $this->sendError('Satuanbarang not found');
        }

        $satuanbarang = $this->satuanbarangRepository->update($input, $id);

        return $this->sendResponse($satuanbarang->toArray(), 'satuanbarang updated successfully');
    }

    /**
     * Remove the specified satuanbarang from storage.
     * DELETE /satuanbarangs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var satuanbarang $satuanbarang */
        $satuanbarang = $this->satuanbarangRepository->find($id);

        if (empty($satuanbarang)) {
            return $this->sendError('Satuanbarang not found');
        }

        $satuanbarang->delete();

        return $this->sendResponse($id, 'Satuanbarang deleted successfully');
    }
}
