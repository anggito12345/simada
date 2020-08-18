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


    public function store(Request $request)
    {
        $input = $request->all();
        try {


            $sensus = $this->inventaris_sensusRepository->create($input);
            $request->merge(['idsensus' => $sensus->id]);


            $fileDokumens = \App\Helpers\FileHelpers::uploadMultiple('dokumen', $request, "inventaris", function ($metadatas, $index, $systemUpload) {
                if (isset($metadatas['dokumen_metadata_keterangan'][$index]) && $metadatas['dokumen_metadata_keterangan'][$index] != null) {
                    $systemUpload->keterangan = $metadatas['dokumen_metadata_keterangan'][$index];
                }

                $systemUpload->uid = $metadatas['dokumen_metadata_uid'][$index];
                $systemUpload->foreign_field = 'id';
                $systemUpload->jenis = 'dokumen';
                $systemUpload->foreign_table = 'sensus';
                $systemUpload->foreign_id = $metadatas['idsensus'];

                return $systemUpload;
            });
            return $this->sendResponse($sensus->toArray(), 'Sensus saved successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }


        return $this->sendResponse([], 'do nothing');
    }

}
