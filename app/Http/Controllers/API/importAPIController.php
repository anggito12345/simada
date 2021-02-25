<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Repositories\importRepository;
use Exception;
use Illuminate\Http\Request;

class importAPIController extends AppBaseController {

    public $importRepository;

    public function __construct(importRepository $importRepository)
    {   
        $this->importRepository = $importRepository;
        $this->middleware('auth:api');
    }

    public function doImport(Request $request) {

        if (!$request->__isset('type') || !$request->__isset('act')) {
            return $this->sendError('type parameter is required', 422);
        }

        try {
            if ($request->input('type') == 'inventaris' && $request->input('act') == 'baru') {
                $this->importRepository->ImportInventarisNew($request);
            } else if ($request->input('type') == 'master-barang' && $request->input('act') == 'update') {
                $this->importRepository->importBarangUpdate($request);
            } else if ($request->input('type') == 'master-organisasi' && $request->input('act') == 'update') {
                $this->importRepository->importOrganisasiUpdate($request);
            }
            
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
        
        return $this->sendResponse([], 'Succesfully import data');

        
    }
}