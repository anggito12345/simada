<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateinventarisSensusAPIRequest;
use App\Http\Requests\API\UpdatealamatAPIRequest;
use App\Models\alamat;
use App\Repositories\inventaris_sensusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Response;

/**
 * Class alamatController
 * @package App\Http\Controllers\API
 */

class inventarisSensusAPIController extends AppBaseController
{
    /** @var  alamatRepository */
    private $inventaris_sensusRepository;

    public function __construct(inventaris_sensusRepository $inventarisSensusRepository)
    {
        $this->inventaris_sensusRepository = $inventarisSensusRepository;
    }


    public function store(CreateinventarisSensusAPIRequest $inventarisSensus)
    {
        try {
            $sensus = $this->inventaris_sensusRepository->create($inventarisSensus);
            return $this->sendResponse($sensus->toArray(), 'Sensus saved successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }


        return $this->sendResponse([], 'do nothing');
    }

}
