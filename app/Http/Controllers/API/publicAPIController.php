<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateorganisasiAPIRequest;
use App\Http\Requests\API\UpdateorganisasiAPIRequest;
use App\Models\organisasi;
use App\Repositories\organisasiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use c;
use Constant;

/**
 * Class organisasiController
 * @package App\Http\Controllers\API
 */

class publicAPIController extends AppBaseController
{
    public function getOrganisasi(Request $request)
    {
        $querys = \App\Models\organisasi::select([
            'm_organisasi.nama as text',
            'm_organisasi.id',      
            'm_organisasi.jabatans',      
            'm_organisasi.kode',
        ]);
        // ->join('m_jenis_opd', 'm_jenis_opd.id', 'm_organisasi.jenis')
        

        if ($request->has('level')) {
            $querys = $querys->where('m_organisasi.jabatans', $request->input('level'));
        }

        if ($request->has('q')) {
            $querys = $querys->whereRaw("m_organisasi.nama ~* '".$request->input('q')."'");
        }


        if ($request->has('term')) {
            $querys = $querys->whereRaw("m_organisasi.nama ~* '".$request->input('term')."'");
        }

        $organisasis = $querys 
            ->get();


        return $this->sendResponse($organisasis->toArray(), 'Organisasis retrieved successfully');
    }
}