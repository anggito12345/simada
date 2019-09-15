<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatebarangAPIRequest;
use App\Http\Requests\API\UpdatebarangAPIRequest;
use App\Models\barang;
use App\Repositories\barangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class barangController
 * @package App\Http\Controllers\API
 */

class barangAPIController extends AppBaseController
{
    /** @var  barangRepository */
    private $barangRepository;

    public function __construct(barangRepository $barangRepo)
    {
        $this->barangRepository = $barangRepo;
    }

    public function lookup(Request $request)
    {

        $query =  new \App\Models\barang();

        $queryFiltered = $query;
        $queryFiltered = \App\Helpers\LookupHelper::build($queryFiltered, $request);

        $barangs = $queryFiltered->skip($request->input('start'))        
        ->limit($request->input('length'))->get();
        return json_encode([
            'data' => $barangs->toArray(),
            'recordsFiltered' => $queryFiltered->count(),
            'recordsTotal' => $query->count(),
        ]);
    }

    /**
     * Display a listing of the barang.
     * GET|HEAD /barangs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $queryBarang =  new \App\Models\barang;

        $queryBarangFinal = $queryBarang;

        if ($request->input("kode_objek") != null && $request->input("kode_jenis") != null && $request->input("kode_rincian_objek") == null) {
            $queryBarangFinal = $queryBarang           
                 ->whereRaw("kode_objek = '".sprintf("%02d",$request->input("kode_objek"))."'")  
                 ->whereRaw("kode_sub_rincian_objek IS NULL")
                 ->whereRaw("kode_rincian_objek IS NOT NULL")
                 ->whereRaw("kode_jenis = '".$request->input("kode_jenis")."'");
        } else if ($request->input("kode_objek") != null && $request->input("kode_jenis") != null && $request->input("kode_rincian_objek") != null) {
            $queryBarangFinal = $queryBarang           
                ->whereRaw("kode_objek = '".sprintf("%02d",$request->input("kode_objek"))."'")  
                ->whereRaw("kode_rincian_objek = '".sprintf("%02d",$request->input("kode_rincian_objek"))."'")
                ->whereRaw("kode_jenis = '".$request->input("kode_jenis")."'")
                ->whereRaw("kode_sub_rincian_objek IS NOT NULL")            ;
        } else if ($request->input("kode_jenis") != null) {
           $queryBarangFinal = $queryBarang             
                ->whereRaw("kode_rincian_objek IS NULL")
                ->whereRaw("kode_objek IS NOT NULL")
                ->whereRaw("kode_jenis = '".$request->input("kode_jenis")."'");
        }        

        if ($request->input('term') != null) {
            $queryBarangFinal = $queryBarangFinal->whereRaw("nama_rek_aset ~* '.*".$request->input("term").".*'");
        }

       
        
        $barangs = $queryBarangFinal->limit(10)
        ->get();

        return $this->sendResponse($barangs->toArray(), 'Barangs retrieved successfully');
    }

    /**
     * Store a newly created barang in storage.
     * POST /barangs
     *
     * @param CreatebarangAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatebarangAPIRequest $request)
    {
        $input = $request->all();

        $barang = $this->barangRepository->create($input);

        return $this->sendResponse($barang->toArray(), 'Barang saved successfully');
    }

    /**
     * Display the specified barang.
     * GET|HEAD /barangs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var barang $barang */
        $barang = $this->barangRepository->find($id);

        if (empty($barang)) {
            return $this->sendError('Barang not found');
        }

        return $this->sendResponse($barang->toArray(), 'Barang retrieved successfully');
    }

    /**
     * Update the specified barang in storage.
     * PUT/PATCH /barangs/{id}
     *
     * @param int $id
     * @param UpdatebarangAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebarangAPIRequest $request)
    {
        $input = $request->all();

        /** @var barang $barang */
        $barang = $this->barangRepository->find($id);

        if (empty($barang)) {
            return $this->sendError('Barang not found');
        }

        $barang = $this->barangRepository->update($input, $id);

        return $this->sendResponse($barang->toArray(), 'barang updated successfully');
    }

    /**
     * Remove the specified barang from storage.
     * DELETE /barangs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var barang $barang */
        $barang = $this->barangRepository->find($id);

        if (empty($barang)) {
            return $this->sendError('Barang not found');
        }

        $barang->delete();

        return $this->sendResponse($id, 'Barang deleted successfully');
    }
}

