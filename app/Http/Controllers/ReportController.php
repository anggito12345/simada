<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends AppBaseController
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function DaftarBarang(Request $request) {
        
        return view('report.DaftarBarang');
    }

    public function DaftarBarangIntraKomp(Request $request) {
        
        return view('report.DaftarBarangIntrakomp');
    }

    public function DaftarBarangEkstraKomp(Request $request) {
        
        return view('report.DaftarBarangEkstrakomp');
    }

    public function DaftarMutasiTambah(Request $request) {
        
        return view('report.DaftarMutasiTambah');
    }
    
    public function DaftarMutasiKurang(Request $request) {
        
        return view('report.DaftarMutasiKurang');
    }
    
    public function LampiranBASTMutasi(Request $request) {
        
        return view('report.LampiranBASTMutasi');
    }
    
    public function LampiranSuratUsulan(Request $request) {
        
        return view('report.LampiranSuratUsulan');
    } 
}