<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateinventarisAPIRequest;
use App\Http\Requests\API\UpdateinventarisAPIRequest;
use App\Models\inventaris;
use App\Repositories\inventarisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;
use Auth;

/**
 * Class inventarisController
 * @package App\Http\Controllers\API
 */

class inventarisAPIController extends AppBaseController
{
    /** @var  inventarisRepository */
    private $inventarisRepository;

    public function __construct(inventarisRepository $inventarisRepo)
    {
        $this->inventarisRepository = $inventarisRepo;
    }

    /**
     * Display a listing of the inventaris.
     * GET|HEAD /inventaris
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $inventaris = \App\Models\inventaris::select([
            'noreg as text',
            'id'
        ])
        ->whereRaw("noreg like '%".$request->input("q")."%'")
        ->limit(10)
        ->get();

        return $this->sendResponse($inventaris->toArray(), 'Inventaris retrieved successfully');
    }

    /**
     * Store a newly created inventaris in storage.
     * POST /inventaris
     *
     * @param CreateinventarisAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateinventarisAPIRequest $request)
    {
        $input = $request->all();

        

        $inventaris = $this->inventarisRepository->create($input);

        return $this->sendResponse($inventaris->toArray(), 'Inventaris saved successfully');
    }

    /**
     * Display the specified inventaris.
     * GET|HEAD /inventaris/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var inventaris $inventaris */
        $inventaris = $this->inventarisRepository->find($id);

        if (empty($inventaris)) {
            return $this->sendError('Inventaris not found');
        }

        return $this->sendResponse($inventaris->toArray(), 'Inventaris retrieved successfully');
    }

    /**
     * Update the specified inventaris in storage.
     * PUT/PATCH /inventaris/{id}
     *
     * @param int $id
     * @param UpdateinventarisAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinventarisAPIRequest $request)
    {
        $input = $request->all();

        /** @var inventaris $inventaris */
        $inventaris = $this->inventarisRepository->find($id);

        if (empty($inventaris)) {
            return $this->sendError('Inventaris not found');
        }

        DB::beginTransaction();
        try {
            $input["dokumen"] = "";
            $input["foto"] = "";
            
            \App\Helpers\FileHelpers::uploadMultiple($request->file('dokumen'), $input, "inventaris", function($metadatas, $index, $systemUpload) {
                $systemUpload->keterangan = $metadatas['dokumen_metadata_' . $index . '_keterangan'];
                $systemUpload->uid = $metadatas['dokumen_metadata_' . $index . '_uid'];
                return $systemUpload;
            });

            $inventaris = $this->inventarisRepository->update($input, $id);
            DB::commit();

            return $this->sendResponse($inventaris->toArray(), 'inventaris updated successfully');
        } catch(\Exception $e) {
            DB::rollBack();

            return $this->sendError('Failed save data ' . $e->getMessage() . ' '. $e->getLine());
        }
        

        

        return $this->sendResponse($inventaris->toArray(), 'inventaris updated successfully');
    }

    /**
     * Remove the specified inventaris from storage.
     * DELETE /inventaris/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var inventaris $inventaris */
        $inventaris = $this->inventarisRepository->find($id);

        if (empty($inventaris)) {
            return $this->sendError('Inventaris not found');
        }

        $inventaris->delete();

        return $this->sendResponse($id, 'Inventaris deleted successfully');
    }
}
