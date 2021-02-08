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
}