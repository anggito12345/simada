<?php

namespace App\Http\Controllers\API;

use App\Exports\InventarisPenyusutanPhpSpread;
use App\Http\Requests\API\Createinventaris_reklasAPIRequest;
use App\Http\Requests\API\Updateinventaris_reklasAPIRequest;
use App\Models\inventaris_reklas;
use App\Repositories\inventaris_penyusutanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\inventaris;
use App\Models\inventaris_penyusutan;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * Class inventaris_reklasController
 * @package App\Http\Controllers\API
 */

class inventaris_penyusutanAPIController extends AppBaseController
{
    /** @var  inventaris_penyusutanRepository */
    private $inventarisPenyusutanRepository;

    public function __construct(inventaris_penyusutanRepository $inventarisPenyusutanRepo)
    {
        $this->middleware('auth:api');
        $this->inventarisPenyusutanRepository = $inventarisPenyusutanRepo;
    }

    /**
     * Display a listing of the inventaris_reklas.
     * GET|HEAD /inventarisPenyusutan
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $filter = [];
        if ($request->__isset("pidinventaris")) {
            $filter['inventaris_id'] = $request->get('pidinventaris');
            $this->inventarisPenyusutanRepository->CalculatingPenyusutan($request->get('pidinventaris'));
        }
        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->all(
            $filter,
            ($request->get('start')-1) * $request->get('length'),
            $request->get('length')
        );

        $invPenyusutan = new inventaris_penyusutan();

        

        return [
            "data" => $inventarisPenyusutan->toArray(),
            "recordsTotal" => DB::table($invPenyusutan->table)->count(),
            "draw" => '1',
            "recordsFiltered" => DB::table($invPenyusutan->table)->where($filter)->count(),
        ];
    }

    /**
     * Store a newly created inventaris_reklas in storage.
     * POST /inventarisPenyusutan
     *
     * @param Createinventaris_reklasAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->create($input);

        return $this->sendResponse($inventarisPenyusutan->toArray(), 'Inventaris Penyusutan saved successfully');
    }

    /**
     * Display the specified inventaris_reklas.
     * GET|HEAD /inventarisPenyusutan/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var inventaris_reklas $inventarisPenyusutan */
        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->find($id);

        if (empty($inventarisPenyusutan)) {
            return $this->sendError('Inventaris Penyusutan not found');
        }

        return $this->sendResponse($inventarisPenyusutan->toArray(), 'Inventaris Penyusutan retrieved successfully');
    }

    /**
     * Update the specified inventaris_reklas in storage.
     * PUT/PATCH /inventarisPenyusutan/{id}
     *
     * @param int $id
     * @param Updateinventaris_reklasAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        /** @var inventaris_reklas $inventarisPenyusutan */
        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->find($id);

        if (empty($inventarisPenyusutan)) {
            return $this->sendError('Inventaris Penyusutan not found');
        }

        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->update($input, $id);

        return $this->sendResponse($inventarisPenyusutan->toArray(), 'inventaris_reklas updated successfully');
    }

    /**
     * Remove the specified inventaris_reklas from storage.
     * DELETE /inventarisPenyusutan/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var inventaris_reklas $inventarisPenyusutan */
        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->find($id);

        if (empty($inventarisPenyusutan)) {
            return $this->sendError('Inventaris Penyusutan not found');
        }

        $inventarisPenyusutan->delete();

        return $this->sendSuccess('Inventaris Penyusutan deleted successfully');
    }

    /**
     * calculating all inventaris penyusutan
     */
    public function CalcPenyusutan() {
        try {
            $this->inventarisPenyusutanRepository->CalculatingAllPenyusutanData();
        } catch(Exception $e) {
            return $this->sendError($e->getMessage());
        }
        
        return $this->sendResponse([],'Calculating Successfull!');
    }

    /*
    Export Excel
    
    */

    public function export(Request $request)
    {
        $filename = Auth::user()->id."-inventaris_penyusutan";
        $filter = [];

        if ($request->__isset("pidinventaris")) {
            $filter['inventaris_id'] = $request->get('pidinventaris');
        }

        $asetExp = new InventarisPenyusutanPhpSpread(inventaris_penyusutan::where($filter)->get(), $filename);
        $asetExp->export();

        return $this->sendResponse([
            'filename' => $filename,
            'path' => 'tmp/'.$filename.'.xlsx'
        ] , 'File Exported');
    }

    /**
     * export all data penyusutan
     */

     public function exportAllData(Request $request) {
        $filename = Auth::user()->id."-inventaris_penyusutan-all";
        $filter = [];

        $inventaris = new inventaris();

        $asetExp = new InventarisPenyusutanPhpSpread(
            DB::table($inventaris->table.' as inv')->selectRaw(' 
                inv.id,
                inv.harga_satuan,
                (CASE WHEN barang.umur_ekonomis != 0 THEN inv.harga_satuan/barang.umur_ekonomis else 0 END ) beban_penyusutan_perbulan,
                (CASE WHEN invpe.id IS NULL then barang.umur_ekonomis ELSE invpe.masa_manfaat_sd_akhir_tahun END) masa_manfaat_sd_akhir_tahun,
                (CASE WHEN invpe.id IS NULL then inv.harga_satuan ELSE invpe.penyusutan_sd_tahun_sebelumnya END) penyusutan_sd_tahun_sebelumnya,
                (CASE WHEN invpe.id IS NULL then barang.umur_ekonomis ELSE invpe.running_sd_bulan END) running_sd_bulan,
                (CASE WHEN invpe.id IS NULL then 0 ELSE invpe.bulan_manfaat_berjalan END) bulan_manfaat_berjalan,
                (CASE WHEN invpe.id IS NULL then 0 ELSE invpe.penyusutan_tahun_sekarang END) penyusutan_tahun_sekarang,
                (CASE WHEN invpe.id IS NULL then inv.harga_satuan ELSE invpe.penyusutan_sd_tahun_sekarang END) penyusutan_sd_tahun_sekarang,
                (CASE WHEN invpe.id IS NULL then 0 ELSE invpe.nilai_buku END) nilai_buku')
                ->join('m_barang as barang', 'barang.id', '=', 'inv.pidbarang')
                ->leftJoin(DB::raw('
                        (select 
                            id, 
                            inventaris_id, 
                            masa_manfaat_sd_akhir_tahun,
                            penyusutan_sd_tahun_sebelumnya,
                            running_sd_bulan,
                            bulan_manfaat_berjalan,
                            penyusutan_tahun_sekarang,
                            penyusutan_sd_tahun_sekarang,
                            nilai_buku
                        from report_inventaris_penyusutan rpt
                        group by 
                            id, 
                            inventaris_id, 
                            masa_manfaat_sd_akhir_tahun,
                            penyusutan_sd_tahun_sebelumnya,
                            running_sd_bulan,
                            bulan_manfaat_berjalan,
                            penyusutan_tahun_sekarang,
                            penyusutan_sd_tahun_sekarang,
                            nilai_buku,
                            masa_manfaat_sd_akhir_tahun
                        order by running_penyusutan desc) invpe
                    ')
                    , function($join)
                    {
                       $join->on('invpe.inventaris_id', '=', 'inv.id');
                    })
                ->groupBy(DB::raw('
                    inv.id,
                    barang.umur_ekonomis,
                    invpe.id,
                    invpe.penyusutan_sd_tahun_sebelumnya,
                    invpe.running_sd_bulan,
                    invpe.bulan_manfaat_berjalan,
                    invpe.penyusutan_tahun_sekarang,
                    invpe.penyusutan_sd_tahun_sekarang,
                    invpe.nilai_buku,
                    invpe.masa_manfaat_sd_akhir_tahun
                ')
                )->get(), $filename
        );
        $asetExp->export();

        return $this->sendResponse([
            'filename' => $filename,
            'path' => 'tmp/'.$filename.'.xlsx'
        ] , 'File Exported');
     }
}
