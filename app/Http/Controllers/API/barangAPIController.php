<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatebarangAPIRequest;
use App\Http\Requests\API\UpdatebarangAPIRequest;
use App\Models\barang;
use App\Repositories\barangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class barangController
 * @package App\Http\Controllers\API
 */

class barangAPIController extends AppBaseController
{
    /** @var  barangRepository */
    private $barangRepository;

    public function __construct(barangRepository $barangRepo)
    {
        $this->barangRepository = $barangRepo;
    }

    public function lookup(Request $request)
    {

        $query =  new \App\Models\barang();

        $queryFiltered = $query;
        $searchLookup = $request->input("search-lookup");
        if ($searchLookup != null) {
            if ($searchLookup['nama_rek_aset'] != null) {
                $queryFiltered = $queryFiltered->whereRaw("nama_rek_aset like '%".$searchLookup['nama_rek_aset']."%'");
            }
            
        }

        $barangs = $queryFiltered->skip($request->input('start'))        
        ->limit($request->input('length'))->get();
        return json_encode([
            'data' => $barangs->toArray(),
            'recordsFiltered' => $queryFiltered->count(),
            'recordsTotal' => $query->count(),
        ]);
    }

    /**
     * Display a listing of the barang.
     * GET|HEAD /barangs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $barangs =  \App\Models\barang::select([
            'nama_rek_aset as text',
            'id'
        ])
        ->whereRaw("nama_rek_aset like '%".$request->input("q")."%'")
        ->limit(10)
        ->get();

        return $this->sendResponse($barangs->toArray(), 'Barangs retrieved successfully');
    }

    /**
     * Store a newly created barang in storage.
     * POST /barangs
     *
     * @param CreatebarangAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatebarangAPIRequest $request)
    {
        $input = $request->all();

        $barang = $this->barangRepository->create($input);

        return $this->sendResponse($barang->toArray(), 'Barang saved successfully');
    }

    /**
     * Display the specified barang.
     * GET|HEAD /barangs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var barang $barang */
        $barang = $this->barangRepository->find($id);

        if (empty($barang)) {
            return $this->sendError('Barang not found');
        }

        return $this->sendResponse($barang->toArray(), 'Barang retrieved successfully');
    }

    /**
     * Update the specified barang in storage.
     * PUT/PATCH /barangs/{id}
     *
     * @param int $id
     * @param UpdatebarangAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebarangAPIRequest $request)
    {
        $input = $request->all();

        /** @var barang $barang */
        $barang = $this->barangRepository->find($id);

        if (empty($barang)) {
            return $this->sendError('Barang not found');
        }

        $barang = $this->barangRepository->update($input, $id);

        return $this->sendResponse($barang->toArray(), 'barang updated successfully');
    }

    /**
     * Remove the specified barang from storage.
     * DELETE /barangs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var barang $barang */
        $barang = $this->barangRepository->find($id);

        if (empty($barang)) {
            return $this->sendError('Barang not found');
        }

        $barang->delete();

        return $this->sendResponse($id, 'Barang deleted successfully');
    }
}
