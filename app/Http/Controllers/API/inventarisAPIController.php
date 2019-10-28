<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateinventarisAPIRequest;
use App\Http\Requests\API\UpdateinventarisAPIRequest;
use App\Models\inventaris;
use App\Repositories\inventarisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;
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
        ->whereRaw("noreg like '%".$request->input("term")."%'")
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

                \App\Models\inventaris::saveKib($kibData, $input['tipe_kib']);

                DB::commit();   

            } catch(\Exception $e) {
                DB::rollBack();
                \App\Helpers\FileHelpers::deleteAll($fileDokumens);
                \App\Helpers\FileHelpers::deleteAll($fileFotos);
                \App\Models\inventaris::find($inventaris->id)->delete();
                return $this->sendError($e->getMessage() . $e->getTraceAsString());
            }

            $lastNoReg++;
        }                


        return $this->sendResponse([], 'inventaris updated successfully');

    }

    /** bridge to calculating the value is intra or ekstra
     * 
     * 
     */

    public function intraorekstra(Request $request) {
        try {
            $calculated = \App\Models\inventaris::CalculateIsIntraOrEkstra($request->tahun_perolehan, (int)str_replace(".","",$request->harga_satuan));
            return $this->sendResponse($calculated, 'success');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
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
        $inventaris = \App\Models\inventaris::select([
            'inventaris.*',
            'm_barang.nama_rek_aset'
        ])->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
            ->find($id);

        if (empty($inventaris)) {
            return $this->sendError('Inventaris not found');
        }

        return $this->sendResponse($inventaris->toArray(), 'Inventaris retrieved successfully');
    }

    /**
     * mutasi data ke kib c atau d
     * PUT /mutasi/{id}
     *
     * @param int $id
     * @param UpdateinventarisAPIRequest $request
     *
     * @return Response
     */
    public function mutasi($id, Request $request)
    {
        $input = $request->all();        

        /** @var inventaris $inventaris */
        $inventaris = $this->inventarisRepository->find($id);

        if (empty($inventaris)) {
            return $this->sendError('Inventaris not found');
        }
        
        DB::beginTransaction();
        try {
            
            $detilKontruksi = \App\Models\detilkonstruksi::where('pidinventaris', $id);

            $detilKontruksiArray = $detilKontruksi->first()->toArray();

            if (empty($detilKontruksi)) {
                return $this->sendError('Kontruksi not found');
            }

            $tipe_kib = chr(64+(int)$input['tipe_kib']);

            if ($tipe_kib == 'A') {
                $prepareSave = $detilKontruksiArray;               

                if(isset($detilKontruksiArray['kodetanah'])) {       

                    $detilTanahFromForeign = \App\Models\detiltanah::find($detilKontruksiArray['kodetanah'])->toArray();
                    $prepareSave['hak'] = $detilTanahFromForeign['hak'];
                    $prepareSave['luas'] = $detilTanahFromForeign['luas'];
                    $prepareSave['status_sertifikat'] = $detilTanahFromForeign['status_sertifikat'];
                    $prepareSave['tgl_sertifikat'] = $detilTanahFromForeign['tgl_sertifikat'];
                    $prepareSave['nomor_sertifikat'] = $detilTanahFromForeign['nomor_sertifikat'];
                    $prepareSave['penggunaan'] = $detilTanahFromForeign['penggunaan'];
                }
                
                
                DB::table('detil_tanah')->insert([
                    'pidinventaris' => $prepareSave['pidinventaris'],
                    'luas' => $prepareSave['luasbangunan'],
                    'alamat' => $prepareSave['alamat'],
                    'idkota' => $prepareSave['idkota'],
                    'idkecamatan' => $prepareSave['idkecamatan'],
                    'idkelurahan' => $prepareSave['idkelurahan'],
                    'koordinatlokasi' => $prepareSave['koordinatlokasi'],
                    'koordinattanah' => $prepareSave['koordinattanah'],
                    'hak' => $prepareSave['hak'],
                    'status_sertifikat' => $prepareSave['status_sertifikat'],
                    'tgl_sertifikat' => $prepareSave['tgl_sertifikat'],
                    'nomor_sertifikat' => $prepareSave['nomor_sertifikat'],
                    'penggunaan' => $prepareSave['penggunaan'],
                    'keterangan' => $prepareSave['keterangan'],
                ]);
            } else if ($tipe_kib == 'B') {
                DB::table('detil_mesin')->insert([
                    'pidinventaris' => $detilKontruksiArray['pidinventaris'],                  
                    'keterangan' => $detilKontruksiArray['keterangan'],   
                ]);
            } else if ($tipe_kib == 'C') {
                DB::table('detil_bangunan')->insert([
                    'pidinventaris' => $detilKontruksiArray['pidinventaris'],
                    'konstruksi'  => $detilKontruksiArray['konstruksi'],
                    'bertingkat' => $detilKontruksiArray['bertingkat'],
                    'beton' => $detilKontruksiArray['beton'],
                    'luasbangunan' => $detilKontruksiArray['luasbangunan'],
                    'alamat' => $detilKontruksiArray['alamat'],
                    'idkota' => $detilKontruksiArray['idkota'],
                    'idkecamatan' => $detilKontruksiArray['idkecamatan'],
                    'idkelurahan' => $detilKontruksiArray['idkelurahan'],
                    'koordinatlokasi' => $detilKontruksiArray['koordinatlokasi'],
                    'koordinattanah' => $detilKontruksiArray['koordinattanah'],
                    'tgldokumen' => $detilKontruksiArray['tgldokumen'],
                    'nodokumen' => $detilKontruksiArray['nodokumen'],
                    'luastanah' => $detilKontruksiArray['luastanah'],
                    'statustanah' => $detilKontruksiArray['statustanah'],
                    'kodetanah' => $detilKontruksiArray['kodetanah'],        
                    'keterangan' => $detilKontruksiArray['keterangan'],   
                ]);
            } else if ($tipe_kib == 'D') {
                DB::table('detil_jalan')->insert([
                    'pidinventaris' => $detilKontruksiArray['pidinventaris'],
                    'konstruksi'  => $detilKontruksiArray['konstruksi'],
                    'luas' => $detilKontruksiArray['luasbangunan'],
                    'alamat' => $detilKontruksiArray['alamat'],
                    'idkota' => $detilKontruksiArray['idkota'],
                    'idkecamatan' => $detilKontruksiArray['idkecamatan'],
                    'idkelurahan' => $detilKontruksiArray['idkelurahan'],
                    'koordinatlokasi' => $detilKontruksiArray['koordinatlokasi'],
                    'koordinattanah' => $detilKontruksiArray['koordinattanah'],
                    'tgldokumen' => $detilKontruksiArray['tgldokumen'],
                    'nodokumen' => $detilKontruksiArray['nodokumen'],
                    'luastanah' => $detilKontruksiArray['luastanah'],
                    'statustanah' => $detilKontruksiArray['statustanah'],
                    'kodetanah' => $detilKontruksiArray['kodetanah'],        
                    'keterangan' => $detilKontruksiArray['keterangan'],                       
                ]);
            } else if ($tipe_kib == 'E') {
                DB::table('detil_aset_lainnya')->insert([
                    'pidinventaris' => $detilKontruksiArray['pidinventaris'],                  
                    'keterangan' => $detilKontruksiArray['keterangan'],   
                ]);
            }

            // $detilKontruksi->delete();

            $barangMaster = \App\Models\barang::find($input['newidbarang']);

            $currentNoReg = DB::table('inventaris')
                ->select([
                    'inventaris.*',                    
                ])
                ->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
                ->where('m_barang.kode_jenis', '=', $barangMaster->kode_jenis)
                ->where('inventaris.tahun_perolehan', '=', $inventaris->tahun_perolehan)
                ->where('inventaris.harga_satuan', '=', str_replace(".","", $inventaris->harga_satuan))
                ->orderBy('inventaris.noreg', 'desc')
                ->lockForUpdate()->first();
            
            $lastNoReg = 0;
            if ($currentNoReg != null) {
                $lastNoReg = (int)$currentNoReg->noreg;
            }            

            $inventaris->noreg = sprintf('%03d',$lastNoReg + 1);
            $inventaris->pidbarang = $input['newidbarang'];

            $inventaris->update();

            DB::commit();   

            return $this->sendResponse($inventaris->toArray(), 'inventaris updated successfully');
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage() . $e->getTraceAsString());
        }
        
        return $this->sendResponse($inventaris->toArray(), 'inventaris updated successfully');
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

            \App\Models\inventaris::saveKib($kibData, $input['tipe_kib']);

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
        $ids = explode("|",$id);
        
        foreach ($ids as $key => $id) {
            # code...
             /** @var inventaris $inventaris */

            DB::beginTransaction();
            try {
                $inventaris = $this->inventarisRepository->find($id);
                if (empty($inventaris)) {
                    return $this->sendError('Inventaris not found');
                }

                $querySystemUpload = \App\Models\system_upload::where([
                    'foreign_table' => 'inventaris',
                    'foreign_id' => $id,
                ]);
        
        
                $dataSystemUploads = $querySystemUpload->get();
        
                foreach ($dataSystemUploads as $key => $value) {
                    Storage::delete($value->path);
                }
        
                $querySystemUpload->delete();
    
                $inventaris->forceDelete();
                
                DB::commit(); 
            } catch(\Exception $e) {
                DB::rollBack();
            }
            

        }

       
        return $this->sendResponse($id, 'Inventaris deleted successfully');
    }
}
