<?php

namespace App\Http\Controllers\API;

use App\Repositories\inventaris_sensusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\inventaris;
use App\Models\inventaris_sensus;
use App\Repositories\inventarisRepository;

/**
 * Class alamatController
 * @package App\Http\Controllers\API
 */

class inventarisSensusAPIController extends AppBaseController
{
    /** @var  alamatRepository */
    private $inventaris_sensusRepository;
    private $inventarisRepository;

    public function __construct(inventaris_sensusRepository $inventaris_sensusRepository, inventarisRepository $inventarisRepository)
    {
        $this->middleware('auth:api');
        $this->inventaris_sensusRepository = $inventaris_sensusRepository;
        $this->inventarisRepository = $inventarisRepository;
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

    public function checkIfInProgress(Request $request)
    {
        try {
            $invSensus = inventaris_sensus::where("idinventaris", $request->route('id'))->orderBy("id", "DESC")->first();

            if (empty($invSensus)) {
                return $this->sendResponse([
                    "Data" => true
                ], "Data Retrieved");
            }

            if ($invSensus->status_approval != "STEP-2") {
                    return $this->sendResponse([
                        "Data" => false
                    ], "Data Retrieved");
            }

            return $this->sendResponse([
                    "Data" => true
                ], "Data Retrieved");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }


        return $this->sendResponse([], 'do nothing');
    }

    public function cancelSensus(Request $request)
    {
        try {
            $id = $request->route('id');
            if (strpos($id, ",")) {
                $ids = explode(",", $id);
                for ($i=0; $i < count($ids); $i++) {
                    $idData = $ids[$i];
                    inventaris_sensus::find($idData)->delete();
                }
            } else {
                inventaris_sensus::find($id)->delete();
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse([], 'do nothing');
    }
}
