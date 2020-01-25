<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatekoreksiAPIRequest;
use App\Http\Requests\API\UpdatekoreksiAPIRequest;
use App\Models\koreksi;
use App\Models\koreksi_detil;
use App\Repositories\koreksiRepository;
use App\Repositories\inventarisRepository;
use App\Repositories\inventaris_historyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\Constant;

/**
 * Class koreksiController
 * @package App\Http\Controllers\API
 */

class koreksiAPIController extends AppBaseController
{
    /** @var  koreksiRepository */
    private $koreksiRepository;
    private $inventarisRepository;
    private $inventaris_historyRepository;

    public function __construct(koreksiRepository $koreksiRepo, inventarisRepository $inventarisRepository, inventaris_historyRepository $inventaris_historyRepository)
    {
        $this->middleware('auth:api');
        $this->koreksiRepository = $koreksiRepo;
        $this->inventarisRepository = $inventarisRepository;
        $this->inventaris_historyRepository = $inventaris_historyRepository;
    }

    /**
     * Display a listing of the koreksi.
     * GET|HEAD /koreksis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $koreksis = $this->koreksiRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($koreksis->toArray(), 'Koreksis retrieved successfully');
    }

    /**
     * Store a newly created koreksi in storage.
     * POST /koreksis
     *
     * @param CreatekoreksiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatekoreksiAPIRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::id();

        try {
            DB::beginTransaction();

            $koreksi = $this->koreksiRepository->create($input);

            $request->merge(['idkoreksi' => $koreksi->id]);

            $details = json_decode($request->input('data-detil'), true);

            foreach ($details as $detail) {
                $inventaris = $this->inventarisRepository->find($detail['pidinventaris']);

                // insert koreksi detil
                $detailRecord = [
                    'idkoreksi' => $koreksi->id,
                    'pidinventaris' => $detail['pidinventaris'],
                    'harga_satuan_lama' => $inventaris->harga_satuan,
                    'harga_satuan_baru' => $detail['nilai_baru'],
                ];

                koreksi_detil::create($detailRecord);

                // save inventaris to history
                $this->inventaris_historyRepository->postHistory($inventaris->toArray(), Constant::$ACTION_HISTORY['KOREKSI']);

                // update harga satuan with harga satuan baru
                $this->inventarisRepository->update(['harga_satuan' => $detail['nilai_baru']], $detail['pidinventaris']);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }


        return $this->sendResponse($koreksi->toArray(), 'Koreksi saved successfully');
    }

    /**
     * Display the specified koreksi.
     * GET|HEAD /koreksis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var koreksi $koreksi */
        $koreksi = $this->koreksiRepository->find($id);

        if (empty($koreksi)) {
            return $this->sendError('Koreksi not found');
        }

        return $this->sendResponse($koreksi->toArray(), 'Koreksi retrieved successfully');
    }

    /**
     * Update the specified koreksi in storage.
     * PUT/PATCH /koreksis/{id}
     *
     * @param int $id
     * @param UpdatekoreksiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatekoreksiAPIRequest $request)
    {
        $input = $request->all();

        /** @var koreksi $koreksi */
        $koreksi = $this->koreksiRepository->find($id);

        if (empty($koreksi)) {
            return $this->sendError('Koreksi not found');
        }

        $koreksi = $this->koreksiRepository->update($input, $id);

        return $this->sendResponse($koreksi->toArray(), 'koreksi updated successfully');
    }

    /**
     * Remove the specified koreksi from storage.
     * DELETE /koreksis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var koreksi $koreksi */
        $koreksi = $this->koreksiRepository->find($id);

        if (empty($koreksi)) {
            return $this->sendError('Koreksi not found');
        }

        $koreksi->delete();

        return $this->sendSuccess('Koreksi deleted successfully');
    }
}
