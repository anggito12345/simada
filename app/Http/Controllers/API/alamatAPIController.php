<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatealamatAPIRequest;
use App\Http\Requests\API\UpdatealamatAPIRequest;
use App\Models\alamat;
use App\Repositories\alamatRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class alamatController
 * @package App\Http\Controllers\API
 */

class alamatAPIController extends AppBaseController
{
    /** @var  alamatRepository */
    private $alamatRepository;

    public function __construct(alamatRepository $alamatRepo)
    {
        $this->alamatRepository = $alamatRepo;
    }

    /**
     * Display a listing of the alamat.
     * GET|HEAD /alamats
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {   
        $fieldText = "nama";

        if ($request->__isset("fieldText")) {
            $fieldText = $request->input("fieldText");
        }

        $query = \App\Models\alamat::selectRaw(
            $fieldText." as text, id
        ")
        ->whereRaw("nama like '%".$request->input("q")."%'");
        

        if ($request->__isset("addWhere")) {
            foreach ($request->input("addWhere") as $key => $value) {
                $query = $query->whereRaw($value);
            }            
        }

        $alamats = $query->limit(10)
        ->get();

        return $this->sendResponse($alamats->toArray(), 'Alamats retrieved successfully');
    }

    /**
     * Store a newly created alamat in storage.
     * POST /alamats
     *
     * @param CreatealamatAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatealamatAPIRequest $request)
    {
        $input = $request->all();

        $alamat = $this->alamatRepository->create($input);

        return $this->sendResponse($alamat->toArray(), 'Alamat saved successfully');
    }

    /**
     * Display the specified alamat.
     * GET|HEAD /alamats/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var alamat $alamat */
        $alamat = $this->alamatRepository->find($id);

        if (empty($alamat)) {
            return $this->sendError('Alamat not found');
        }

        return $this->sendResponse($alamat->toArray(), 'Alamat retrieved successfully');
    }

    /**
     * Update the specified alamat in storage.
     * PUT/PATCH /alamats/{id}
     *
     * @param int $id
     * @param UpdatealamatAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatealamatAPIRequest $request)
    {
        $input = $request->all();

        /** @var alamat $alamat */
        $alamat = $this->alamatRepository->find($id);

        if (empty($alamat)) {
            return $this->sendError('Alamat not found');
        }

        $alamat = $this->alamatRepository->update($input, $id);

        return $this->sendResponse($alamat->toArray(), 'alamat updated successfully');
    }

    /**
     * Remove the specified alamat from storage.
     * DELETE /alamats/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var alamat $alamat */
        $alamat = $this->alamatRepository->find($id);

        if (empty($alamat)) {
            return $this->sendError('Alamat not found');
        }

        $alamat->delete();

        return $this->sendResponse($id, 'Alamat deleted successfully');
    }
}
