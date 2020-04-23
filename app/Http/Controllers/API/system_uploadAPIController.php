<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createsystem_uploadAPIRequest;
use App\Http\Requests\API\Updatesystem_uploadAPIRequest;
use App\Models\system_upload;
use App\Repositories\system_uploadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class system_uploadController
 * @package App\Http\Controllers\API
 */

class system_uploadAPIController extends AppBaseController
{
    /** @var  system_uploadRepository */
    private $systemUploadRepository;

    public function __construct(system_uploadRepository $systemUploadRepo)
    {
        $this->systemUploadRepository = $systemUploadRepo;
    }

    /**
     * Display a listing of the system_upload.
     * GET|HEAD /systemUploads
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = new \App\Models\system_upload();
        $query = $query->select([
            'system_upload.*'
        ]); 

        if (!$request->input('foreign_table')) {
            return $this->sendError('foreign_table is required');
        }

        if ($request->input('foreign_table')) {
            $query = $query->where('system_upload.foreign_table', '=', $request->input('foreign_table'));            
        }

        if ($request->input('jenis')) {
            $query = $query->where('system_upload.jenis', '=', $request->input('jenis'));            
        }

        if ($request->input('foreign_id')) {
            $query = $query->where('system_upload.foreign_id', '=', $request->input('foreign_id'));            
        } else {
            return $this->sendResponse([], 'System Uploads retrieved successfully');
        }

        if ($request->has('foreign_field') && $request->has('foreign_id')) {
            $query = $query->join($request->input('foreign_table'), $request->input('foreign_table') . '.' . $request->input('foreign_field'), 'system_upload.foreign_id');
        }
        
        $systemUploads = $query->get();

        return $this->sendResponse($systemUploads->toArray(), 'System Uploads retrieved successfully');
    }

    

    /**
     * Store a newly created system_upload in storage.
     * POST /systemUploads
     *
     * @param Createsystem_uploadAPIRequest $request
     *
     * @return Response
     */
    public function store(Createsystem_uploadAPIRequest $request)
    {
        $input = $request->all();

        $systemUpload = $this->systemUploadRepository->create($input);

        return $this->sendResponse($systemUpload->toArray(), 'System Upload saved successfully');
    }

    /**
     * Display the specified system_upload.
     * GET|HEAD /systemUploads/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var system_upload $systemUpload */
        $systemUpload = $this->systemUploadRepository->find($id);

        if (empty($systemUpload)) {
            return $this->sendError('System Upload not found');
        }

        return $this->sendResponse($systemUpload->toArray(), 'System Upload retrieved successfully');
    }

    /**
     * Update the specified system_upload in storage.
     * PUT/PATCH /systemUploads/{id}
     *
     * @param int $id
     * @param Updatesystem_uploadAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesystem_uploadAPIRequest $request)
    {
        $input = $request->all();

        /** @var system_upload $systemUpload */
        $systemUpload = $this->systemUploadRepository->find($id);

        if (empty($systemUpload)) {
            return $this->sendError('System Upload not found');
        }

        $systemUpload = $this->systemUploadRepository->update($input, $id);

        return $this->sendResponse($systemUpload->toArray(), 'system_upload updated successfully');
    }

    /**
     * Remove the specified system_upload from storage.
     * DELETE /systemUploads/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {


        $ids = explode(",", $id);
        
        $systemUploads = \App\Models\system_upload::whereIn('id', $ids)->get();

        \App\Helpers\FileHelpers::deleteAll($systemUploads, true);

        if (empty($systemUploads)) {
            return $this->sendError('System Upload not found');
        }

        return $this->sendResponse($id, 'System Upload deleted successfully');
    }


    public function get(Request $request, $encrypted) 
    {
        $data = \App\Models\system_upload::whereRaw('path LIKE \'%'.$encrypted.'%\'')->first();

        if (!file_exists(storage_path('app/'.$data->path))) {
            return response([
                'Data' => 'File does not exists'
            ]);
        } else {
            return response()->download(storage_path('app/'.$data->path), $data->name, [
                'Content-Type' => mime_content_type($data->name)
            ]);
        }

        
    }
}
