<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\sys_workflow_master;

class sys_workflow_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_sys_workflow_master()
    {
        $sysWorkflowMaster = factory(sys_workflow_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sys_workflow_masters', $sysWorkflowMaster
        );

        $this->assertApiResponse($sysWorkflowMaster);
    }

    /**
     * @test
     */
    public function test_read_sys_workflow_master()
    {
        $sysWorkflowMaster = factory(sys_workflow_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/sys_workflow_masters/'.$sysWorkflowMaster->id
        );

        $this->assertApiResponse($sysWorkflowMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_sys_workflow_master()
    {
        $sysWorkflowMaster = factory(sys_workflow_master::class)->create();
        $editedsys_workflow_master = factory(sys_workflow_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sys_workflow_masters/'.$sysWorkflowMaster->id,
            $editedsys_workflow_master
        );

        $this->assertApiResponse($editedsys_workflow_master);
    }

    /**
     * @test
     */
    public function test_delete_sys_workflow_master()
    {
        $sysWorkflowMaster = factory(sys_workflow_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sys_workflow_masters/'.$sysWorkflowMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sys_workflow_masters/'.$sysWorkflowMaster->id
        );

        $this->response->assertStatus(404);
    }
}
