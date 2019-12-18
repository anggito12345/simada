<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepenghapusanAPIRequest;
use App\Http\Requests\API\UpdatepenghapusanAPIRequest;
use App\Models\penghapusan;
use App\Repositories\penghapusanRepository;
use App\Repositories\inventaris_penghapusanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

/**
 * Class penghapusanController
 * @package App\Http\Controllers\API
 */

class penghapusanAPIController extends AppBaseController
{
    /** @var  penghapusanRepository */
    private $penghapusanRepository;
    private $inventaris_penghapusanRepository;

    public function __construct(penghapusanRepository $penghapusanRepo, inventaris_penghapusanRepository $inventaris_penghapusanRepository)
    {
        $this->penghapusanRepository = $penghapusanRepo;
        $this->inventaris_penghapusanRepository = $inventaris_penghapusanRepository;
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the penghapusan.
     * GET|HEAD /penghapusans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $penghapusans = $this->penghapusanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($penghapusans->toArray(), 'Penghapusans retrieved successfully');
    }

    /**
     * Store a newly created penghapusan in storage.
     * POST /penghapusans
     *
     * @param CreatepenghapusanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepenghapusanAPIRequest $request)
    {
        $input = $request->all();

        $fileDokumens = [];
        $fileFotos = [];

        $input['created_by'] = Auth::id();

        $penghapusan = $this->penghapusanRepository->create($input);

        $request->merge(['idpenghapusan' => $penghapusan->id]); 


        DB::beginTransaction();
        try {
            
            $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "penghapusan", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                }
                
                $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'dokumen';
                $systemUpload->foreign_table = 'penghapusan';
                $systemUpload->foreign_id = $metadatas['idpenghapusan'];                   

                return $systemUpload;
            });


            $fileFotos = \App\Helpers\FileHelpers::uploadMultiple('foto', $request, "penghapusan", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['foto_metadata_keterangan'][$index]) && $metadatas['foto_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['foto_metadata_keterangan'][$index];
                }
                $systemUpload->uid = $metadatas['foto_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'foto';
                $systemUpload->foreign_table = 'penghapusan';
                $systemUpload->foreign_id = $metadatas['idpenghapusan'];
                                

                return $systemUpload;
            });                

            $dataDetils = json_decode($request->input('detil'), true);

            if ($request->input('draft')) {
                $this->inventaris_penghapusanRepository->moveInventaris($dataDetils, $penghapusan->id);
            }            

            DB::commit();   

        } catch(\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            \App\Helpers\FileHelpers::deleteAll($fileFotos);   
            \App\Models\penghapusan::withDrafts()->find($penghapusan->id)->delete();             
            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }

        

        return $this->sendResponse($penghapusan->toArray(), 'Penghapusan saved successfully');
    }

    /**
     * Display the specified penghapusan.
     * GET|HEAD /penghapusans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var penghapusan $penghapusan */
        $penghapusan = penghapusan::withDrafts()->find($id);

        if (empty($penghapusan)) {
            return $this->sendError('Penghapusan not found');
        }

        return $this->sendResponse($penghapusan->toArray(), 'Penghapusan retrieved successfully');
    }

    /**
     * Update the specified penghapusan in storage.
     * PUT/PATCH /penghapusans/{id}
     *
     * @param int $id
     * @param UpdatepenghapusanAPIRequest $request
     *
     * @return Response
     */
    // public function update($id, UpdatepenghapusanAPIRequest $request)
    // {
    //     $input = $request->all();

    //     $fileDokumens = [];
    //     $fileFotos = [];

    //     /** @var penghapusan $penghapusan */
    //     $penghapusan = $this->penghapusanRepository->find($id);

    //     if (empty($penghapusan)) {
    //         return $this->sendError('Penghapusan not found');
    //     }

    //     DB::beginTransaction();
    //     try {
            
    //         $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "penghapusan", function($metadatas, $index, $systemUpload) {
    //             if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
    //                 $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
    //             }
                
    //             $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];             
    //             $systemUpload->foreign_field = 'id';
    //             $systemUpload->jenis = 'dokumen';
    //             $systemUpload->foreign_table = 'penghapusan';
    //             $systemUpload->foreign_id = $metadatas['id'];                   

    //             return $systemUpload;
    //         });


    //         $fileFotos = \App\Helpers\FileHelpers::uploadMultiple('foto', $request, "penghapusan", function($metadatas, $index, $systemUpload) {
    //             if (isset($metadatas['foto_metadata_keterangan'][$index]) && $metadatas['foto_metadata_keterangan'][$index] != null) {
    //                 $systemUpload->keterangan = $metadatas['foto_metadata_keterangan'][$index];
    //             }
    //             $systemUpload->uid = $metadatas['foto_metadata_uid'][$index];             
    //             $systemUpload->foreign_field = 'id';
    //             $systemUpload->jenis = 'foto';
    //             $systemUpload->foreign_table = 'penghapusan';
    //             $systemUpload->foreign_id = $metadatas['id'];
                                

    //             return $systemUpload;
    //         });                

    //         $penghapusan = $this->penghapusanRepository->update($input, $id);

    //         \App\Models\inventaris::find($input['pidinventaris'])->restore();

    //         DB::commit();   

    //     } catch(\Exception $e) {
    //         DB::rollBack();
    //         \App\Helpers\FileHelpers::deleteAll($fileDokumens);
    //         \App\Helpers\FileHelpers::deleteAll($fileFotos);              
    //         return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
    //     }

        

    //     return $this->sendResponse($penghapusan->toArray(), 'penghapusan updated successfully');
    // }

    

    public function update($id, UpdatepenghapusanAPIRequest $request)
    {
        $input = $request->all();

        $fileDokumens = [];
        $fileFotos = [];


        /** @var penghapusan $penghapusan */
        $penghapusan = penghapusan::withDrafts()->find($id);

        if (empty($penghapusan)) {
            return $this->sendError('Penghapusan not found');
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
                $systemUpload->foreign_table = 'penghapusan';
                $systemUpload->foreign_id = $metadatas['id'];                   

                return $systemUpload;
            });


            $fileFotos = \App\Helpers\FileHelpers::uploadMultiple('foto', $request, "penghapusan", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['foto_metadata_keterangan'][$index]) && $metadatas['foto_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['foto_metadata_keterangan'][$index];
                }
                $systemUpload->uid = $metadatas['foto_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'foto';
                $systemUpload->foreign_table = 'penghapusan';
                $systemUpload->foreign_id = $metadatas['id'];
                                

                return $systemUpload;
            });                

            $penghapusan = $this->penghapusanRepository->update($input, $id);

            if ($request->input('draft')) {
                $this->inventaris_penghapusanRepository->moveInventaris($dataDetils, $penghapusan->id);
            }    

            DB::commit();   

        } catch(\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            \App\Helpers\FileHelpers::deleteAll($fileFotos);              
            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }

        

        return $this->sendResponse($penghapusan->toArray(), 'penghapusan updated successfully');
    }

    /**
     * Remove the specified penghapusan from storage.
     * DELETE /penghapusans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        

        $ids = explode("|",$id);
        
        foreach ($ids as $key => $id) {
            # code...
             /** @var inventaris $inventaris */

            DB::beginTransaction();
            try {
                /** @var penghapusan $penghapusan */
                $penghapusan = penghapusan::withDrafts()->find($id);

                if (empty($penghapusan)) {
                    return $this->sendError('Penghapusan not found');
                }                

                $querySystemUpload = \App\Models\system_upload::where([
                    'foreign_table' => 'penghapusan',
                    'foreign_id' => $id,
                ]);
        
        
                $dataSystemUploads = $querySystemUpload->get();
        
                foreach ($dataSystemUploads as $key => $value) {
                    Storage::delete($value->path);
                }
        
                $querySystemUpload->delete();


                \App\Models\inventaris::withTrashed()->find($penghapusan->pidinventaris)->restore();    
    
                $penghapusan->delete();
                
                DB::commit(); 
            } catch(\Exception $e) {
                DB::rollBack();
            }
            

        }



        return $this->sendResponse($id, 'Penghapusan deleted successfully');
    }
}
