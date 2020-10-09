<?php

namespace App\Http\Controllers;

use App\DataTables\sys_workflowDataTable;
use App\Http\Requests;
use App\Http\Requests\Createsys_workflowRequest;
use App\Http\Requests\Updatesys_workflowRequest;
use App\Repositories\sys_workflowRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class sys_workflowController extends AppBaseController
{
    /** @var  sys_workflowRepository */
    private $sysWorkflowRepository;

    public function __construct(sys_workflowRepository $sysWorkflowRepo)
    {
        $this->sysWorkflowRepository = $sysWorkflowRepo;
    }

    /**
     * Display a listing of the sys_workflow.
     *
     * @param sys_workflowDataTable $sysWorkflowDataTable
     * @return Response
     */
    public function index(sys_workflowDataTable $sysWorkflowDataTable)
    {
        return $sysWorkflowDataTable->render('sys_workflows.index');
    }

    /**
     * Show the form for creating a new sys_workflow.
     *
     * @return Response
     */
    public function create()
    {
        return view('sys_workflows.create');
    }

    /**
     * Store a newly created sys_workflow in storage.
     *
     * @param Createsys_workflowRequest $request
     *
     * @return Response
     */
    public function store(Createsys_workflowRequest $request)
    {
        $input = $request->all();

        $sysWorkflow = $this->sysWorkflowRepository->create($input);

        Flash::success('Sys Workflow saved successfully.');

        return redirect(route('sysWorkflows.index'));
    }

    /**
     * Display the specified sys_workflow.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sysWorkflow = $this->sysWorkflowRepository->find($id);

        if (empty($sysWorkflow)) {
            Flash::error('Sys Workflow not found');

            return redirect(route('sysWorkflows.index'));
        }

        return view('sys_workflows.show')->with('sysWorkflow', $sysWorkflow);
    }

    /**
     * Show the form for editing the specified sys_workflow.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sysWorkflow = $this->sysWorkflowRepository->find($id);

        if (empty($sysWorkflow)) {
            Flash::error('Sys Workflow not found');

            return redirect(route('sysWorkflows.index'));
        }

        return view('sys_workflows.edit')->with('sysWorkflow', $sysWorkflow);
    }

    /**
     * Update the specified sys_workflow in storage.
     *
     * @param  int              $id
     * @param Updatesys_workflowRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesys_workflowRequest $request)
    {
        $sysWorkflow = $this->sysWorkflowRepository->find($id);

        if (empty($sysWorkflow)) {
            Flash::error('Sys Workflow not found');

            return redirect(route('sysWorkflows.index'));
        }

        $sysWorkflow = $this->sysWorkflowRepository->update($request->all(), $id);

        Flash::success('Sys Workflow updated successfully.');

        return redirect(route('sysWorkflows.index'));
    }

    /**
     * Remove the specified sys_workflow from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sysWorkflow = $this->sysWorkflowRepository->find($id);

        if (empty($sysWorkflow)) {
            Flash::error('Sys Workflow not found');

            return redirect(route('sysWorkflows.index'));
        }

        $this->sysWorkflowRepository->delete($id);

        Flash::success('Sys Workflow deleted successfully.');

        return redirect(route('sysWorkflows.index'));
    }
}
