<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemerkbarangAPIRequest;
use App\Http\Requests\API\UpdatemerkbarangAPIRequest;
use App\Models\merkbarang;
use App\Repositories\merkbarangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class merkbarangController
 * @package App\Http\Controllers\API
 */

class merkbarangAPIController extends AppBaseController
{
    /** @var  merkbarangRepository */
    private $merkbarangRepository;

    public function __construct(merkbarangRepository $merkbarangRepo)
    {
        $this->merkbarangRepository = $merkbarangRepo;
    }

    /**
     * Display a listing of the merkbarang.
     * GET|HEAD /merkbarangs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $merkbarangs = \App\Models\merkbarang::select([
            'nama as text',
            'id'
        ])
        ->whereRaw("nama like '%".$request->input("term")."%'")
        ->limit(10)
        ->get();

        return $this->sendResponse($merkbarangs->toArray(), 'Merkbarangs retrieved successfully');
    }

    /**
     * Store a newly created merkbarang in storage.
     * POST /merkbarangs
     *
     * @param CreatemerkbarangAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemerkbarangAPIRequest $request)
    {
        $input = $request->all();

        $merkbarang = $this->merkbarangRepository->create($input);

        return $this->sendResponse($merkbarang->toArray(), 'Merkbarang saved successfully');
    }

    /**
     * Display the specified merkbarang.
     * GET|HEAD /merkbarangs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var merkbarang $merkbarang */
        $merkbarang = $this->merkbarangRepository->find($id);

        if (empty($merkbarang)) {
            return $this->sendError('Merkbarang not found');
        }

        return $this->sendResponse($merkbarang->toArray(), 'Merkbarang retrieved successfully');
    }

    /**
     * Update the specified merkbarang in storage.
     * PUT/PATCH /merkbarangs/{id}
     *
     * @param int $id
     * @param UpdatemerkbarangAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemerkbarangAPIRequest $request)
    {
        $input = $request->all();

        /** @var merkbarang $merkbarang */
        $merkbarang = $this->merkbarangRepository->find($id);

        if (empty($merkbarang)) {
            return $this->sendError('Merkbarang not found');
        }

        $merkbarang = $this->merkbarangRepository->update($input, $id);

        return $this->sendResponse($merkbarang->toArray(), 'merkbarang updated successfully');
    }

    /**
     * Remove the specified merkbarang from storage.
     * DELETE /merkbarangs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var merkbarang $merkbarang */
        $merkbarang = $this->merkbarangRepository->find($id);

        if (empty($merkbarang)) {
            return $this->sendError('Merkbarang not found');
        }

        $merkbarang->delete();

        return $this->sendResponse($id, 'Merkbarang deleted successfully');
    }
}
