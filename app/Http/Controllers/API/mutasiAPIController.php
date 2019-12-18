<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemutasiAPIRequest;
use App\Http\Requests\API\UpdatemutasiAPIRequest;
use App\Models\mutasi;
use App\Repositories\mutasiRepository;
use App\Repositories\inventaris_mutasiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

/**
 * Class mutasiController
 * @package App\Http\Controllers\API
 */

class mutasiAPIController extends AppBaseController
{
    /** @var  mutasiRepository */
    private $mutasiRepository;
    private $inventaris_mutasiRepository;

    public function __construct(mutasiRepository $mutasiRepo, inventaris_mutasiRepository $inventaris_mutasiRepository)
    {
        $this->mutasiRepository = $mutasiRepo;
        $this->inventaris_mutasiRepository = $inventaris_mutasiRepository;
    }

    /**
     * Display a listing of the mutasi.
     * GET|HEAD /mutasis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $mutasis = $this->mutasiRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($mutasis->toArray(), 'Mutasis retrieved successfully');
    }

    /**
     * Store a newly created mutasi in storage.
     * POST /mutasis
     *
     * @param CreatemutasiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemutasiAPIRequest $request)
    {
        $input = $request->all();

        $mutasi = $this->mutasiRepository->create($input);

        $request->merge(['idmutasi' => $mutasi->id]); 

        DB::beginTransaction();
        try {
            
            $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "mutasi", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                }
                
                $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'Dokumen Pengajuan Mutasi';
                $systemUpload->foreign_table = 'mutasi';
                $systemUpload->foreign_id = $metadatas['idmutasi'];                 

                return $systemUpload;
            });

            $dataDetils = json_decode($request->input('data-detil'), true);

            if ($request->input('draft')) {
                $this->inventaris_mutasiRepository->moveInventaris($dataDetils, $mutasi->id);
            }                             

            DB::commit();   

        } catch(\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            \App\Models\mutasi::withDrafts()->find($mutasi->id)->delete();             
            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }


        return $this->sendResponse($mutasi->toArray(), 'Mutasi saved successfully');
    }

    /**
     * Display the specified mutasi.
     * GET|HEAD /mutasis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var mutasi $mutasi */
        $mutasi = mutasi::withDrafts()->find($id);

        if (empty($mutasi)) {
            return $this->sendError('Mutasi not found');
        }

        return $this->sendResponse($mutasi->toArray(), 'Mutasi retrieved successfully');
    }

    /**
     * Update the specified mutasi in storage.
     * PUT/PATCH /mutasis/{id}
     *
     * @param int $id
     * @param UpdatemutasiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemutasiAPIRequest $request)
    {
        $input = $request->all();

        /** @var mutasi $mutasi */
        $mutasi = mutasi::withDrafts()->find($id);

        if (empty($mutasi)) {
            return $this->sendError('Mutasi not found');
        }

        $request->merge(['id' => $id]); 

        DB::beginTransaction();
        try {
            
            $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "penghapusan", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                }
                
                $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'dokumen';
                $systemUpload->foreign_table = 'mutasi';
                $systemUpload->foreign_id = $metadatas['id'];                   

                return $systemUpload;
            });             

            $rka = $this->mutasiRepository->update($input, $id);

            $dataDetils = json_decode($request->input('data-detil'), true);

            if ($request->input('draft')) {
                $this->inventaris_mutasiRepository->moveInventaris($dataDetils, $mutasi->id);
            }  

            DB::commit();   

        } catch(\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }

        return $this->sendResponse($mutasi->toArray(), 'mutasi updated successfully');
    }

    /**
     * Remove the specified mutasi from storage.
     * DELETE /mutasis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var mutasi $mutasi */
        $mutasi = mutasi::withDrafts()->find($id);

        if (empty($mutasi)) {
            return $this->sendError('Mutasi not found');
        }

        $mutasi->delete();

        $querySystemUpload = \App\Models\system_upload::where([
            'foreign_table' => 'mutasi',
            'foreign_id' => $id,
        ]);


        $dataSystemUploads = $querySystemUpload->get();

        foreach ($dataSystemUploads as $key => $value) {
            Storage::delete($value->path);
        }

        $querySystemUpload->delete(); 

        return $this->sendResponse($id, 'Mutasi deleted successfully');
    }
}
