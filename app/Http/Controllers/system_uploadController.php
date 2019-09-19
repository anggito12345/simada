<?php

namespace App\Http\Controllers;

use App\DataTables\system_uploadDataTable;
use App\Http\Requests;
use App\Http\Requests\Createsystem_uploadRequest;
use App\Http\Requests\Updatesystem_uploadRequest;
use App\Repositories\system_uploadRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class system_uploadController extends AppBaseController
{
    /** @var  system_uploadRepository */
    private $systemUploadRepository;

    public function __construct(system_uploadRepository $systemUploadRepo)
    {
        $this->systemUploadRepository = $systemUploadRepo;
    }

    /**
     * Display a listing of the system_upload.
     *
     * @param system_uploadDataTable $systemUploadDataTable
     * @return Response
     */
    public function index(system_uploadDataTable $systemUploadDataTable)
    {
        return $systemUploadDataTable->render('system_uploads.index');
    }

    /**
     * Show the form for creating a new system_upload.
     *
     * @return Response
     */
    public function create()
    {
        return view('system_uploads.create');
    }

    /**
     * Store a newly created system_upload in storage.
     *
     * @param Createsystem_uploadRequest $request
     *
     * @return Response
     */
    public function store(Createsystem_uploadRequest $request)
    {
        $input = $request->all();

        $systemUpload = $this->systemUploadRepository->create($input);

        Flash::success('System Upload saved successfully.');

        return redirect(route('systemUploads.index'));
    }

    /**
     * Display the specified system_upload.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $systemUpload = $this->systemUploadRepository->find($id);

        if (empty($systemUpload)) {
            Flash::error('System Upload not found');

            return redirect(route('systemUploads.index'));
        }

        return view('system_uploads.show')->with('systemUpload', $systemUpload);
    }

    /**
     * Show the form for editing the specified system_upload.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $systemUpload = $this->systemUploadRepository->find($id);

        if (empty($systemUpload)) {
            Flash::error('System Upload not found');

            return redirect(route('systemUploads.index'));
        }

        return view('system_uploads.edit')->with('systemUpload', $systemUpload);
    }

    /**
     * Update the specified system_upload in storage.
     *
     * @param  int              $id
     * @param Updatesystem_uploadRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesystem_uploadRequest $request)
    {
        $systemUpload = $this->systemUploadRepository->find($id);

        if (empty($systemUpload)) {
            Flash::error('System Upload not found');

            return redirect(route('systemUploads.index'));
        }

        $systemUpload = $this->systemUploadRepository->update($request->all(), $id);

        Flash::success('System Upload updated successfully.');

        return redirect(route('systemUploads.index'));
    }

    /**
     * Remove the specified system_upload from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $systemUpload = $this->systemUploadRepository->find($id);

        if (empty($systemUpload)) {
            Flash::error('System Upload not found');

            return redirect(route('systemUploads.index'));
        }

        $this->systemUploadRepository->delete($id);

        Flash::success('System Upload deleted successfully.');

        return redirect(route('systemUploads.index'));
    }
}
