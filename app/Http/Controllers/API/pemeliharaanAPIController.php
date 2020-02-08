<?php

namespace App\Http\Controllers\API;

use App\Helpers\Constant;
use App\Http\Requests\API\CreatepemeliharaanAPIRequest;
use App\Http\Requests\API\UpdatepemeliharaanAPIRequest;
use App\Models\pemeliharaan;
use App\Repositories\pemeliharaanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\inventaris;
use App\Repositories\inventaris_historyRepository;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class pemeliharaanController
 * @package App\Http\Controllers\API
 */

class pemeliharaanAPIController extends AppBaseController
{
    /** @var  pemeliharaanRepository */
    private $pemeliharaanRepository;
    private $inventaris_historyRepository;

    public function __construct(pemeliharaanRepository $pemeliharaanRepo, inventaris_historyRepository $inventaris_historyRepository)
    {
        $this->middleware('auth:api');
        $this->pemeliharaanRepository = $pemeliharaanRepo;
        $this->inventaris_historyRepository = $inventaris_historyRepository;
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
        $input['created_by'] = Auth::id();

        DB::beginTransaction();
        $fileMedias = [];

        try {
            $inventaris = inventaris::find($input['pidinventaris']);

            if (empty($inventaris)) {
                return $this->sendError('inventaris not found', 500);
            }

            if (empty($request->input('draft'))) {
                $inventaris->update([
                    'umur_ekonomis' => (int) $inventaris->umur_ekonomis + (int) $input['umur_ekonomis'],
                    'harga_satuan' => (int) $inventaris->harga_satuan + (int) $input['biaya'],
                ]);

                $inventarisHistory = $inventaris->toArray();

                $this->inventaris_historyRepository->postHistory($inventarisHistory, Constant::$ACTION_HISTORY['PEM1']);
            }

            $pemeliharaan = $this->pemeliharaanRepository->create($input);
            $request->merge(['idpemeliharaan' => $pemeliharaan->id]); 

            $fileMedias = \App\Helpers\FileHelpers::uploadMultiple('media_pemeliharaan', $request, 'pemeliharaan', function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['media_pemeliharaan_metadata_keterangan'][$index]) && $metadatas['media_pemeliharaan_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['media_pemeliharaan_metadata_keterangan'][$index];
                }

                $systemUpload->uid = $metadatas['media_pemeliharaan_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'media';
                $systemUpload->foreign_table = 'pemeliharaan';
                $systemUpload->foreign_id = $metadatas['idpemeliharaan'];
                                
                return $systemUpload;
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            \App\Helpers\FileHelpers::deleteAll($fileMedias);

            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine(), 500);
        }



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
        $pemeliharaan = \App\Models\pemeliharaan::whereRaw("id IN ({$id})");

        if (empty($pemeliharaan)) {
            return $this->sendError('Pemeliharaan not found');
        }

        $pemeliharaan->delete();

        return $this->sendResponse($id, 'Pemeliharaan deleted successfully');
    }
}
