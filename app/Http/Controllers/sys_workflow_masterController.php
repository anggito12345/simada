<?php

namespace App\Http\Controllers;

use App\DataTables\sys_workflow_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\Createsys_workflow_masterRequest;
use App\Http\Requests\Updatesys_workflow_masterRequest;
use App\Repositories\sys_workflow_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class sys_workflow_masterController extends AppBaseController
{
    /** @var  sys_workflow_masterRepository */
    private $sysWorkflowMasterRepository;

    public function __construct(sys_workflow_masterRepository $sysWorkflowMasterRepo)
    {
        $this->sysWorkflowMasterRepository = $sysWorkflowMasterRepo;
    }

    /**
     * Display a listing of the sys_workflow_master.
     *
     * @param sys_workflow_masterDataTable $sysWorkflowMasterDataTable
     * @return Response
     */
    public function index(sys_workflow_masterDataTable $sysWorkflowMasterDataTable)
    {
        return $sysWorkflowMasterDataTable->render('sys_workflow_masters.index');
    }

    /**
     * Show the form for creating a new sys_workflow_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('sys_workflow_masters.create');
    }

    /**
     * Store a newly created sys_workflow_master in storage.
     *
     * @param Createsys_workflow_masterRequest $request
     *
     * @return Response
     */
    public function store(Createsys_workflow_masterRequest $request)
    {
        $input = $request->all();

        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->create($input);

        Flash::success('Sys Workflow Master saved successfully.');

        return redirect(route('sysWorkflowMasters.index'));
    }

    /**
     * Display the specified sys_workflow_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->find($id);

        if (empty($sysWorkflowMaster)) {
            Flash::error('Sys Workflow Master not found');

            return redirect(route('sysWorkflowMasters.index'));
        }

        return view('sys_workflow_masters.show')->with('sysWorkflowMaster', $sysWorkflowMaster);
    }

    /**
     * Show the form for editing the specified sys_workflow_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->find($id);

        if (empty($sysWorkflowMaster)) {
            Flash::error('Sys Workflow Master not found');

            return redirect(route('sysWorkflowMasters.index'));
        }

        return view('sys_workflow_masters.edit')->with('sysWorkflowMaster', $sysWorkflowMaster);
    }

    /**
     * Update the specified sys_workflow_master in storage.
     *
     * @param  int              $id
     * @param Updatesys_workflow_masterRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesys_workflow_masterRequest $request)
    {
        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->find($id);

        if (empty($sysWorkflowMaster)) {
            Flash::error('Sys Workflow Master not found');

            return redirect(route('sysWorkflowMasters.index'));
        }

        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->update($request->all(), $id);

        Flash::success('Sys Workflow Master updated successfully.');

        return redirect(route('sysWorkflowMasters.index'));
    }

    /**
     * Remove the specified sys_workflow_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->find($id);

        if (empty($sysWorkflowMaster)) {
            Flash::error('Sys Workflow Master not found');

            return redirect(route('sysWorkflowMasters.index'));
        }

        $this->sysWorkflowMasterRepository->delete($id);

        Flash::success('Sys Workflow Master deleted successfully.');

        return redirect(route('sysWorkflowMasters.index'));
    }
}
