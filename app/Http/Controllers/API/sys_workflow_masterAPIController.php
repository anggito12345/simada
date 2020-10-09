<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createsys_workflow_masterAPIRequest;
use App\Http\Requests\API\Updatesys_workflow_masterAPIRequest;
use App\Models\sys_workflow_master;
use App\Repositories\sys_workflow_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class sys_workflow_masterController
 * @package App\Http\Controllers\API
 */

class sys_workflow_masterAPIController extends AppBaseController
{
    /** @var  sys_workflow_masterRepository */
    private $sysWorkflowMasterRepository;

    public function __construct(sys_workflow_masterRepository $sysWorkflowMasterRepo)
    {
        $this->sysWorkflowMasterRepository = $sysWorkflowMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/sysWorkflowMasters",
     *      summary="Get a listing of the sys_workflow_masters.",
     *      tags={"sys_workflow_master"},
     *      description="Get all sys_workflow_masters",
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
     *                  @SWG\Items(ref="#/definitions/sys_workflow_master")
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
        $sysWorkflowMasters = $this->sysWorkflowMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($sysWorkflowMasters->toArray(), 'Sys Workflow Masters retrieved successfully');
    }

    /**
     * @param Createsys_workflow_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/sysWorkflowMasters",
     *      summary="Store a newly created sys_workflow_master in storage",
     *      tags={"sys_workflow_master"},
     *      description="Store sys_workflow_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="sys_workflow_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/sys_workflow_master")
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
     *                  ref="#/definitions/sys_workflow_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createsys_workflow_masterAPIRequest $request)
    {
        $input = $request->all();

        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->create($input);

        return $this->sendResponse($sysWorkflowMaster->toArray(), 'Sys Workflow Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/sysWorkflowMasters/{id}",
     *      summary="Display the specified sys_workflow_master",
     *      tags={"sys_workflow_master"},
     *      description="Get sys_workflow_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of sys_workflow_master",
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
     *                  ref="#/definitions/sys_workflow_master"
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
        /** @var sys_workflow_master $sysWorkflowMaster */
        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->find($id);

        if (empty($sysWorkflowMaster)) {
            return $this->sendError('Sys Workflow Master not found');
        }

        return $this->sendResponse($sysWorkflowMaster->toArray(), 'Sys Workflow Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updatesys_workflow_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/sysWorkflowMasters/{id}",
     *      summary="Update the specified sys_workflow_master in storage",
     *      tags={"sys_workflow_master"},
     *      description="Update sys_workflow_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of sys_workflow_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="sys_workflow_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/sys_workflow_master")
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
     *                  ref="#/definitions/sys_workflow_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updatesys_workflow_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var sys_workflow_master $sysWorkflowMaster */
        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->find($id);

        if (empty($sysWorkflowMaster)) {
            return $this->sendError('Sys Workflow Master not found');
        }

        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->update($input, $id);

        return $this->sendResponse($sysWorkflowMaster->toArray(), 'sys_workflow_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/sysWorkflowMasters/{id}",
     *      summary="Remove the specified sys_workflow_master from storage",
     *      tags={"sys_workflow_master"},
     *      description="Delete sys_workflow_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of sys_workflow_master",
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
        /** @var sys_workflow_master $sysWorkflowMaster */
        $sysWorkflowMaster = $this->sysWorkflowMasterRepository->find($id);

        if (empty($sysWorkflowMaster)) {
            return $this->sendError('Sys Workflow Master not found');
        }

        $sysWorkflowMaster->delete();

        return $this->sendSuccess('Sys Workflow Master deleted successfully');
    }
}
