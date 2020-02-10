<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatereklasAPIRequest;
use App\Http\Requests\API\UpdatereklasAPIRequest;
use App\Models\reklas;
use App\Models\reklas_detil;
use App\Repositories\reklasRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class reklasController
 * @package App\Http\Controllers\API
 */

class reklasAPIController extends AppBaseController
{
    /** @var  reklasRepository */
    private $reklasRepository;

    public function __construct(reklasRepository $reklasRepo)
    {
        $this->middleware('auth:api');
        $this->reklasRepository = $reklasRepo;
    }

    /**
     * Display a listing of the reklas.
     * GET|HEAD /reklas
     *
     * @param Request $request
     * @return Responserka_detil
     */
    public function index(Request $request)
    {
        $reklas = $this->reklasRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($reklas->toArray(), 'Reklas retrieved successfully');
    }

    /**
     * Store a newly created reklas in storage.
     * POST /reklas
     *
     * @param CreatereklasAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatereklasAPIRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::id();
        $fileDokumens = [];

        try {
            DB::beginTransaction();

            $reklas = $this->reklasRepository->create($input);

            $request->merge(['idreklas' => $reklas->id]);

            $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen_reklas', $request, "reklas", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['dokumen_reklas_metadata_keterangan'][$index]) && $metadatas['dokumen_reklas_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['dokumen_reklas_metadata_keterangan'][$index];
                }

                $systemUpload->uid = $metadatas['dokumen_reklas_metadata_uid'][$index];      
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'dokumen';
                $systemUpload->foreign_table = 'reklas';
                $systemUpload->foreign_id = $metadatas['idreklas'];                 

                return $systemUpload;
            });

            $details = json_decode($request->input('data-detil'), true);

            foreach ($details as $detail) {
                $detailRecord = [
                    'idreklas' => $reklas->id,
                    'pidinventaris' => $detail['kode_awal'],
                    'pidbarang_tujuan' => $detail['kode_tujuan'],
                    'status' => 'STEP-1',
                ];

                reklas_detil::create($detailRecord);
            }
                             
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);

            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }

        return $this->sendResponse($reklas->toArray(), 'Reklas saved successfully');
    }

    /**
     * Display the specified reklas.
     * GET|HEAD /reklas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var reklas $reklas */
        $reklas = $this->reklasRepository->find($id);

        if (empty($reklas)) {
            return $this->sendError('Reklas not found');
        }

        return $this->sendResponse($reklas->toArray(), 'Reklas retrieved successfully');
    }

    /**
     * Update the specified reklas in storage.
     * PUT/PATCH /reklas/{id}
     *
     * @param int $id
     * @param UpdatereklasAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatereklasAPIRequest $request)
    {
        $input = $request->all();

        /** @var reklas $reklas */
        $reklas = $this->reklasRepository->find($id);

        if (empty($reklas)) {
            return $this->sendError('Reklas not found');
        }

        $reklas = $this->reklasRepository->update($input, $id);

        return $this->sendResponse($reklas->toArray(), 'reklas updated successfully');
    }

    /**
     * Remove the specified reklas from storage.
     * DELETE /reklas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var reklas $reklas */
        $reklas = $this->reklasRepository->find($id);

        if (empty($reklas)) {
            return $this->sendError('Reklas not found');
        }

        $reklas->delete();

        return $this->sendSuccess('Reklas deleted successfully');
    }
}
