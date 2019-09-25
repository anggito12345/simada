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


        // generate no register
        $modelInventaris = new \App\Models\inventaris();

        $barangMaster = \App\Models\barang::find($input['pidbarang']);

        $currentNoReg = DB::table($modelInventaris->table)
                ->select([
                    'inventaris.*',                    
                ])
                ->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
                ->where('m_barang.kode_jenis', '=', $barangMaster->kode_jenis)
                ->where('inventaris.tahun_perolehan', '=', $input['tahun_perolehan'])
                ->where('inventaris.harga_satuan', '=', str_replace(".","", $input['harga_satuan']))
                ->orderBy('inventaris.noreg', 'desc')
                ->lockForUpdate()->first();
            
        $lastNoReg = 0;
        if ($currentNoReg != null) {
            $lastNoReg = (int)$currentNoReg->noreg;
        }            
        for ($i = 0; $i < $input['jumlah'] ; $i ++) {
            
            $input['noreg'] = sprintf('%03d',$lastNoReg + 1);

            $inventaris = $this->inventarisRepository->create($input);

            $request->merge(['idinventaris' => $inventaris["id"]]);            

            $fileDokumens = [];
            $fileFotos = [];

            DB::beginTransaction();
            try {
                
                $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "inventaris", function($metadatas, $index, $systemUpload) {
                    if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                        $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                    }
                    
                    $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];             
                    $systemUpload->foreign_field = 'id';
                    $systemUpload->jenis = 'dokumen';
                    $systemUpload->foreign_table = 'inventaris';
                    $systemUpload->foreign_id = $metadatas['idinventaris'];                   

                    return $systemUpload;
                });


                $fileFotos = \App\Helpers\FileHelpers::uploadMultiple('foto', $request, "inventaris", function($metadatas, $index, $systemUpload) {
                    if (isset($metadatas['foto_metadata_keterangan'][$index]) && $metadatas['foto_metadata_keterangan'][$index] != null) {
                        $systemUpload->keterangan = $metadatas['foto_metadata_keterangan'][$index];
                    }
                    $systemUpload->uid = $metadatas['foto_metadata_uid'][$index];             
                    $systemUpload->foreign_field = 'id';
                    $systemUpload->jenis = 'foto';
                    $systemUpload->foreign_table = 'inventaris';
                    $systemUpload->foreign_id = $metadatas['idinventaris'];
                                   

                    return $systemUpload;
                });

                $kibData = json_decode($input['kib'], true);

                $kibData['pidinventaris'] = $inventaris->id;

                \App\Models\inventaris::saveKib($kibData, 'A');

                DB::commit();   

            } catch(\Exception $e) {
                DB::rollBack();
                \App\Helpers\FileHelpers::deleteAll($fileDokumens);
                \App\Helpers\FileHelpers::deleteAll($fileFotos);
                \App\models\inventaris::find($inventaris->id)->delete();
                return $this->sendError($e->getMessage() . $e->getTraceAsString());
            }

            $lastNoReg++;
        }                


        return $this->sendResponse([], 'inventaris updated successfully');

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
        
        $fileDokumens = [];
        $fileFotos = [];

        DB::beginTransaction();
        try {
            
            $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "inventaris", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                }
                
                $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'dokumen';
                $systemUpload->foreign_table = 'inventaris';
                $systemUpload->foreign_id = $metadatas['dokumen_metadata_id_inventaris'][$index];              

                return $systemUpload;
            });


            $fileFotos = \App\Helpers\FileHelpers::uploadMultiple('foto', $request, "inventaris", function($metadatas, $index, $systemUpload) {
                if (isset($metadatas['foto_metadata_keterangan'][$index]) && $metadatas['foto_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['foto_metadata_keterangan'][$index];
                }
                $systemUpload->uid = $metadatas['foto_metadata_uid'][$index];             
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'foto';
                $systemUpload->foreign_table = 'inventaris';                                
                $systemUpload->foreign_id = $metadatas['foto_metadata_id_inventaris'][$index];        

                return $systemUpload;
            });

            $inventaris = $this->inventarisRepository->update($input, $id);

            $kibData = json_decode($input['kib'], true);

            $kibData['pidinventaris'] = $id;

            \App\Models\inventaris::saveKib($kibData, 'A');

            DB::commit();   

            return $this->sendResponse($inventaris->toArray(), 'inventaris updated successfully');
        } catch(\Exception $e) {
            DB::rollBack();
            \App\Helpers\FileHelpers::deleteAll($fileDokumens);
            \App\Helpers\FileHelpers::deleteAll($fileFotos);
            return $this->sendError($e->getMessage() . $e->getTraceAsString());
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
