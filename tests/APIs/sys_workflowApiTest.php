<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\sys_workflow;

class sys_workflowApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_sys_workflow()
    {
        $sysWorkflow = factory(sys_workflow::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sys_workflows', $sysWorkflow
        );

        $this->assertApiResponse($sysWorkflow);
    }

    /**
     * @test
     */
    public function test_read_sys_workflow()
    {
        $sysWorkflow = factory(sys_workflow::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/sys_workflows/'.$sysWorkflow->id
        );

        $this->assertApiResponse($sysWorkflow->toArray());
    }

    /**
     * @test
     */
    public function test_update_sys_workflow()
    {
        $sysWorkflow = factory(sys_workflow::class)->create();
        $editedsys_workflow = factory(sys_workflow::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sys_workflows/'.$sysWorkflow->id,
            $editedsys_workflow
        );

        $this->assertApiResponse($editedsys_workflow);
    }

    /**
     * @test
     */
    public function test_delete_sys_workflow()
    {
        $sysWorkflow = factory(sys_workflow::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sys_workflows/'.$sysWorkflow->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sys_workflows/'.$sysWorkflow->id
        );

        $this->response->assertStatus(404);
    }
}
