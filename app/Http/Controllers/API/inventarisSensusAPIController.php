<?php

namespace App\Http\Controllers\API;

use App\Repositories\inventaris_sensusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\inventaris;


/**
 * Class alamatController
 * @package App\Http\Controllers\API
 */

class inventarisSensusAPIController extends AppBaseController
{
    /** @var  alamatRepository */
    private $inventaris_sensusRepository;

    public function __construct(inventaris_sensusRepository $inventaris_sensusRepository)
    {
        $this->middleware('auth:api');
        $this->inventaris_sensusRepository = $inventaris_sensusRepository;
    }


    public function store(Request $request)
    {
        try {
            return $this->sendResponse($this->inventaris_sensusRepository->insertLogic($request), 'Sensus saved successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }


        return $this->sendResponse([], 'do nothing');
    }

}
