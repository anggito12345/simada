<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreaterkaAPIRequest;
use App\Http\Requests\API\UpdaterkaAPIRequest;
use App\Models\rka;
use App\Repositories\rkaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

/**
 * Class rkaController
 * @package App\Http\Controllers\API
 */

class rkaAPIController extends AppBaseController
{
    /** @var  rkaRepository */
    private $rkaRepository;

    public function __construct(rkaRepository $rkaRepo)
    {
        $this->rkaRepository = $rkaRepo;
    }

    /**
     * Display a listing of the rka.
     * GET|HEAD /rkas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $rkas = $this->rkaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rkas->toArray(), 'Rkas retrieved successfully');
    }

    /**
     * Store a newly created rka in storage.
     * POST /rkas
     *
     * @param CreaterkaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreaterkaAPIRequest $request)
    {
        $input = $request->all();

        $rka = $this->rkaRepository->create($input);

        $request->merge(['idrka' => $rka->id]); 

        DB::beginTransaction();
        try {
            
            $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "mutasi", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                }
                
                $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'dokumen';
                $systemUpload->foreign_table = 'rka';
                $systemUpload->foreign_id = $metadatas['idrka'];                 

                return $systemUpload;
            });

            $dataDetils = json_decode($request->input('data-detil'), true);

            foreach ($dataDetils as $dataDetil) {                

                $dataDetil['pid'] = $request->input('idrka');
                \App\Models\rka_detil::create($dataDetil);
            }
                             

            DB::commit();   

        } catch(\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            \App\Models\rka::find($rka->id)->delete();             
            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }

        return $this->sendResponse($rka->toArray(), 'Rka saved successfully');
    }

    /**
     * Display the specified rka.
     * GET|HEAD /rkas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var rka $rka */
        $rka = $this->rkaRepository->find($id);

        if (empty($rka)) {
            return $this->sendError('Rka not found');
        }

        return $this->sendResponse($rka->toArray(), 'Rka retrieved successfully');
    }

    /**
     * Update the specified rka in storage.
     * PUT/PATCH /rkas/{id}
     *
     * @param int $id
     * @param UpdaterkaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterkaAPIRequest $request)
    {
        $input = $request->all();

        /** @var rka $rka */
        $rka = $this->rkaRepository->find($id);

        if (empty($rka)) {
            return $this->sendError('Rka not found');
        }

        $rka = $this->rkaRepository->update($input, $id);

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
                $systemUpload->foreign_table = 'rka';
                $systemUpload->foreign_id = $metadatas['id'];                   

                return $systemUpload;
            });             

            $rka = $this->rkaRepository->update($input, $id);

            $dataDetils = json_decode($request->input('data-detil'), true);

            foreach ($dataDetils as $dataDetil) {   
                $exist = null;
                // check if exist or not
                if (isset($dataDetil['id']))
                    $exist = \App\Models\rka_detil::find($dataDetil['id']);
                if(!empty($exist)) {
                    $exist->pid = $request->input('id');
                    $exist->fill($dataDetil);
                    $exist->update();                    
                } else {
                    $dataDetil['pid'] = $request->input('id');
                    \App\Models\rka_detil::create($dataDetil);
                }        
            }


                               

            DB::commit();   

        } catch(\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }

        return $this->sendResponse($rka->toArray(), 'rka updated successfully');
    }

    /**
     * Remove the specified rka from storage.
     * DELETE /rkas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var rka $rka */
        $rka = $this->rkaRepository->find($id);

        if (empty($rka)) {
            return $this->sendError('Rka not found');
        }

        $rka->delete();

        return $this->sendResponse($id, 'Rka deleted successfully');
    }
}
