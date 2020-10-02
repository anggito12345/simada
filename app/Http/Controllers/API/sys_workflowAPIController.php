<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createsys_workflowAPIRequest;
use App\Http\Requests\API\Updatesys_workflowAPIRequest;
use App\Models\sys_workflow;
use App\Repositories\sys_workflowRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class sys_workflowController
 * @package App\Http\Controllers\API
 */

class sys_workflowAPIController extends AppBaseController
{
    /** @var  sys_workflowRepository */
    private $sysWorkflowRepository;

    public function __construct(sys_workflowRepository $sysWorkflowRepo)
    {
        $this->sysWorkflowRepository = $sysWorkflowRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/sysWorkflows",
     *      summary="Get a listing of the sys_workflows.",
     *      tags={"sys_workflow"},
     *      description="Get all sys_workflows",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/sys_workflow")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $sysWorkflows = $this->sysWorkflowRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($sysWorkflows->toArray(), 'Sys Workflows retrieved successfully');
    }

    /**
     * @param Createsys_workflowAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/sysWorkflows",
     *      summary="Store a newly created sys_workflow in storage",
     *      tags={"sys_workflow"},
     *      description="Store sys_workflow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="sys_workflow that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/sys_workflow")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/sys_workflow"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createsys_workflowAPIRequest $request)
    {
        $input = $request->all();

        $sysWorkflow = $this->sysWorkflowRepository->create($input);

        return $this->sendResponse($sysWorkflow->toArray(), 'Sys Workflow saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/sysWorkflows/{id}",
     *      summary="Display the specified sys_workflow",
     *      tags={"sys_workflow"},
     *      description="Get sys_workflow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of sys_workflow",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/sys_workflow"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var sys_workflow $sysWorkflow */
        $sysWorkflow = $this->sysWorkflowRepository->find($id);

        if (empty($sysWorkflow)) {
            return $this->sendError('Sys Workflow not found');
        }

        return $this->sendResponse($sysWorkflow->toArray(), 'Sys Workflow retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updatesys_workflowAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/sysWorkflows/{id}",
     *      summary="Update the specified sys_workflow in storage",
     *      tags={"sys_workflow"},
     *      description="Update sys_workflow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of sys_workflow",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="sys_workflow that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/sys_workflow")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/sys_workflow"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updatesys_workflowAPIRequest $request)
    {
        $input = $request->all();

        /** @var sys_workflow $sysWorkflow */
        $sysWorkflow = $this->sysWorkflowRepository->find($id);

        if (empty($sysWorkflow)) {
            return $this->sendError('Sys Workflow not found');
        }

        $sysWorkflow = $this->sysWorkflowRepository->update($input, $id);

        return $this->sendResponse($sysWorkflow->toArray(), 'sys_workflow updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/sysWorkflows/{id}",
     *      summary="Remove the specified sys_workflow from storage",
     *      tags={"sys_workflow"},
     *      description="Delete sys_workflow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of sys_workflow",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var sys_workflow $sysWorkflow */
        $sysWorkflow = $this->sysWorkflowRepository->find($id);

        if (empty($sysWorkflow)) {
            return $this->sendError('Sys Workflow not found');
        }

        $sysWorkflow->delete();

        return $this->sendSuccess('Sys Workflow deleted successfully');
    }
}
