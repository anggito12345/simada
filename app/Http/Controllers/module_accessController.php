<?php

namespace App\Http\Controllers;

use App\DataTables\module_accessDataTable;
use App\Http\Requests;
use App\Http\Requests\Createmodule_accessRequest;
use App\Http\Requests\Updatemodule_accessRequest;
use App\Repositories\module_accessRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class module_accessController extends AppBaseController
{
    /** @var  module_accessRepository */
    private $moduleAccessRepository;

    public function __construct(module_accessRepository $moduleAccessRepo)
    {
        $this->moduleAccessRepository = $moduleAccessRepo;
    }

    /**
     * Display a listing of the module_access.
     *
     * @param module_accessDataTable $moduleAccessDataTable
     * @return Response
     */
    public function index(module_accessDataTable $moduleAccessDataTable)
    {
        return $moduleAccessDataTable->render('module_accesses.index');
    }

    /**
     * Show the form for creating a new module_access.
     *
     * @return Response
     */
    public function create()
    {
        return view('module_accesses.create');
    }

    /**
     * Store a newly created module_access in storage.
     *
     * @param Createmodule_accessRequest $request
     *
     * @return Response
     */
    public function store(Createmodule_accessRequest $request)
    {
        $input = $request->all();

        $moduleAccess = $this->moduleAccessRepository->create($input);

        Flash::success('Module Access saved successfully.');

        return redirect(route('moduleAccesses.index'));
    }

    /**
     * Display the specified module_access.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $moduleAccess = $this->moduleAccessRepository->find($id);

        if (empty($moduleAccess)) {
            Flash::error('Module Access not found');

            return redirect(route('moduleAccesses.index'));
        }

        return view('module_accesses.show')->with('moduleAccess', $moduleAccess);
    }

    /**
     * Show the form for editing the specified module_access.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $moduleAccess = $this->moduleAccessRepository->find($id);

        if (empty($moduleAccess)) {
            Flash::error('Module Access not found');

            return redirect(route('moduleAccesses.index'));
        }

        return view('module_accesses.edit')->with('moduleAccess', $moduleAccess);
    }

    /**
     * Update the specified module_access in storage.
     *
     * @param  int              $id
     * @param Updatemodule_accessRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemodule_accessRequest $request)
    {
        $moduleAccess = $this->moduleAccessRepository->find($id);

        if (empty($moduleAccess)) {
            Flash::error('Module Access not found');

            return redirect(route('moduleAccesses.index'));
        }

        $moduleAccess = $this->moduleAccessRepository->update($request->all(), $id);

        Flash::success('Module Access updated successfully.');

        return redirect(route('moduleAccesses.index'));
    }

    /**
     * Remove the specified module_access from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $moduleAccess = $this->moduleAccessRepository->find($id);

        if (empty($moduleAccess)) {
            Flash::error('Module Access not found');

            return redirect(route('moduleAccesses.index'));
        }

        $this->moduleAccessRepository->delete($id);

        Flash::success('Module Access deleted successfully.');

        return redirect(route('moduleAccesses.index'));
    }
}
