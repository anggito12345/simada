<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Repositories\reportRepository;
use Illuminate\Http\Request;

class ReportAPIController extends AppBaseController
{
    public $reportRepository;

    public function __construct(reportRepository $reportRepository)
    {
        $this->middleware('auth:api');
        $this->reportRepository = $reportRepository;
    }   

    public function DaftarBarang(Request $request) {
        $filter = [];

        if ($request->__isset("f_penggunafilter")) {
            array_push($filter, [
                'pidopd' => $request->input('f_penggunafilter')
            ]);
        }

        if ($request->__isset("f_subkuasa_filter")) {
            array_push($filter, [
                'pidopd_cabang' => $request->input('f_subkuasa_filter')
            ]);
        }

        if ($request->__isset("f_kuasapengguna_filter")) {
            array_push($filter, [
                'pidupt' => $request->input('f_kuasapengguna_filter')
            ]);
        }


        if ($request->__isset("f_jenisbarangs")) {
            array_push($filter, [
                'barang.kode_jenis' => $request->input('f_jenisbarangs')
            ]);
        }

        if ($request->__isset("f_kodeobjek")) {
            array_push($filter, [
                'barang.kode_objek' => $request->input('f_kodeobjek')
            ]);
        }

        if ($request->__isset("f_koderincianobjek")) {
            array_push($filter, [
                'barang.kode_rincian_objek' => $request->input('f_koderincianobjek')
            ]);
        }

        $res = $this->reportRepository->GetDataDaftarBarang(true, [
            'skip' => $request->input('start'),
            'take' => $request->input('length'),
            'filters' => $filter
        ]);

        

        $res['draw'] = $request->input('draw');
        return $res;
    }
}