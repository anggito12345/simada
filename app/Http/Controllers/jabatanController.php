<?php

namespace App\Http\Controllers;

use App\DataTables\jabatanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatejabatanRequest;
use App\Http\Requests\UpdatejabatanRequest;
use App\Repositories\jabatanRepository;
use App\Repositories\module_accessRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class jabatanController extends AppBaseController
{
    /** @var  jabatanRepository */
    private $jabatanRepository;
    private $moduleAccessRepository;

    public function __construct(jabatanRepository $jabatanRepo, module_accessRepository $moduleAccessRepository)
    {
        $this->jabatanRepository = $jabatanRepo;
        $this->moduleAccessRepository = $moduleAccessRepository;
    }

    /**
     * Display a listing of the jabatan.
     *
     * @param jabatanDataTable $jabatanDataTable
     * @return Response
     */
    public function index(jabatanDataTable $jabatanDataTable)
    {
        return $jabatanDataTable->render('jabatans.index');
    }

    /**
     * Show the form for creating a new jabatan.
     *
     * @return Response
     */
    public function create()
    {
        return view('jabatans.create');
    }

    /**
     * Store a newly created jabatan in storage.
     *
     * @param CreatejabatanRequest $request
     *
     * @return Response
     */
    public function store(CreatejabatanRequest $request)
    {
        $input = $request->all();

        $jabatan = $this->jabatanRepository->create($input);

        $this->moduleAccessRepository->bulkSaveJabatan($input['access'], $jabatan->id);

        Flash::success('Jabatan saved successfully.');

        return redirect(route('jabatans.index'));
    }

    /**
     * Display the specified jabatan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jabatan = $this->jabatanRepository->find($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        return view('jabatans.show')->with('jabatan', $jabatan);
    }

    /**
     * Show the form for editing the specified jabatan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jabatan = $this->jabatanRepository->find($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        return view('jabatans.edit')->with('jabatan', $jabatan);
    }

    /**
     * Update the specified jabatan in storage.
     *
     * @param  int              $id
     * @param UpdatejabatanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatejabatanRequest $request)
    {
        $jabatan = $this->jabatanRepository->find($id);

        $input = $request->all();

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        $jabatan = $this->jabatanRepository->update( $input, $id);

        if (isset($input['access'])) {
            $this->moduleAccessRepository->bulkSaveJabatan($input['access'], $id);
        }           

        Flash::success('Jabatan updated successfully.');

        return redirect(route('jabatans.index'));
    }

    /**
     * Remove the specified jabatan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jabatan = $this->jabatanRepository->find($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        $this->jabatanRepository->delete($id);

        Flash::success('Jabatan deleted successfully.');

        return redirect(route('jabatans.index'));
    }
}
