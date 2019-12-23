<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepemanfaatanAPIRequest;
use App\Http\Requests\API\UpdatepemanfaatanAPIRequest;
use App\Models\pemanfaatan;
use App\Repositories\pemanfaatanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class pemanfaatanController
 * @package App\Http\Controllers\API
 */

class pemanfaatanAPIController extends AppBaseController
{
    /** @var  pemanfaatanRepository */
    private $pemanfaatanRepository;

    public function __construct(pemanfaatanRepository $pemanfaatanRepo)
    {
        $this->pemanfaatanRepository = $pemanfaatanRepo;
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the pemanfaatan.
     * GET|HEAD /pemanfaatans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $pemanfaatans = $this->pemanfaatanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($pemanfaatans->toArray(), 'Pemanfaatans retrieved successfully');
    }

    /**
     * Store a newly created pemanfaatan in storage.
     * POST /pemanfaatans
     *
     * @param CreatepemanfaatanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepemanfaatanAPIRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::id();

        $pemanfaatan = $this->pemanfaatanRepository->create($input);


        $request->merge(['idpemanfaatan' => $pemanfaatan->id]); 


        DB::beginTransaction();
        try {
            
            $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "penghapusan", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                }
                
                $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'dokumen';
                $systemUpload->foreign_table = 'pemanfaatan';
                $systemUpload->foreign_id = $metadatas['idpemanfaatan'];                   

                return $systemUpload;
            });


            $fileFotos = \App\Helpers\FileHelpers::uploadMultiple('foto', $request, "penghapusan", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['foto_metadata_keterangan'][$index]) && $metadatas['foto_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['foto_metadata_keterangan'][$index];
                }
                $systemUpload->uid = $metadatas['foto_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'foto';
                $systemUpload->foreign_table = 'pemanfaatan';
                $systemUpload->foreign_id = $metadatas['idpemanfaatan'];
                                

                return $systemUpload;
            });                                    

            DB::commit();   

        } catch(\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            \App\Helpers\FileHelpers::deleteAll($fileFotos);   
            \App\Models\pemanfaatan::find($pemanfaatan->id)->delete();             
            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }


        return $this->sendResponse($pemanfaatan->toArray(), 'Pemanfaatan saved successfully');
    }

    /**
     * Display the specified pemanfaatan.
     * GET|HEAD /pemanfaatans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var pemanfaatan $pemanfaatan */
        $pemanfaatan = pemanfaatan::withDrafts()->find($id);

        if (empty($pemanfaatan)) {
            return $this->sendError('Pemanfaatan not found');
        }

        return $this->sendResponse($pemanfaatan->toArray(), 'Pemanfaatan retrieved successfully');
    }

    /**
     * Update the specified pemanfaatan in storage.
     * PUT/PATCH /pemanfaatans/{id}
     *
     * @param int $id
     * @param UpdatepemanfaatanAPIRequest $request
     *
     * @return Response
     */
    // public function update($id, UpdatepemanfaatanAPIRequest $request)
    // {
    //     $input = $request->all();

    //     /** @var pemanfaatan $pemanfaatan */
    //     $pemanfaatan = $this->pemanfaatanRepository->find($id);

    //     if (empty($pemanfaatan)) {
    //         return $this->sendError('Pemanfaatan not found');
    //     }

    //     $pemanfaatan = $this->pemanfaatanRepository->update($input, $id);

    //     return $this->sendResponse($pemanfaatan->toArray(), 'pemanfaatan updated successfully');
    // }

    public function update($id, UpdatepemanfaatanAPIRequest $request)
    {
        $input = $request->all();

        /** @var pemanfaatan $pemanfaatan */
        $pemanfaatan = pemanfaatan::withDrafts()->find($id);

        if (empty($pemanfaatan)) {
            return $this->sendError('Pemanfaatan not found');
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
                $systemUpload->foreign_table = 'pemanfaatan';
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
                $systemUpload->foreign_table = 'pemanfaatan';
                $systemUpload->foreign_id = $metadatas['id'];
                                

                return $systemUpload;
            });                

            $pemanfaatan = $this->pemanfaatanRepository->update($input, $id);


            DB::commit();   

        } catch(\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            \App\Helpers\FileHelpers::deleteAll($fileFotos);              
            return $this->sendError($e->getMessage() . $e->getTraceAsString() . $e->getFile() . $e->getLine());
        }

        

        return $this->sendResponse($pemanfaatan->toArray(), 'pemanfaatan updated successfully');
    }

    /**
     * Remove the specified pemanfaatan from storage.
     * DELETE /pemanfaatans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var pemanfaatan $pemanfaatan */
        $ids = explode("|",$id);
        
        foreach ($ids as $key => $id) {
            # code...
             /** @var inventaris $inventaris */

            DB::beginTransaction();
            try {
                /** @var penghapusan $penghapusan */
                $pemanfaatan = pemanfaatan::withDrafts()->find($id);

                if (empty($pemanfaatan)) {
                    return $this->sendError('Pemanfaatan not found');
                }

                $pemanfaatan->delete();                

                $querySystemUpload = \App\Models\system_upload::where([
                    'foreign_table' => 'pemanfaatan',
                    'foreign_id' => $id,
                ]);
        
        
                $dataSystemUploads = $querySystemUpload->get();
        
                foreach ($dataSystemUploads as $key => $value) {
                    Storage::delete($value->path);
                }
        
                $querySystemUpload->delete();   
    
                $pemanfaatan->delete();
                
                DB::commit(); 
            } catch(\Exception $e) {
                DB::rollBack();
            }
            

        }

        

        return $this->sendResponse($id, 'Pemanfaatan deleted successfully');
    }
}
