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

        $res = $this->reportRepository->GetDataDaftarBarang(true, [
            'skip' => $request->input('start'),
            'take' => $request->input('length'),
            'filters' => $filter
        ]);

        

        $res['draw'] = $request->input('draw');
        return $res;
    }
}