<?php namespace Tests\Repositories;

use App\Models\sys_workflow;
use App\Repositories\sys_workflowRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class sys_workflowRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var sys_workflowRepository
     */
    protected $sysWorkflowRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->sysWorkflowRepo = \App::make(sys_workflowRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_sys_workflow()
    {
        $sysWorkflow = factory(sys_workflow::class)->make()->toArray();

        $createdsys_workflow = $this->sysWorkflowRepo->create($sysWorkflow);

        $createdsys_workflow = $createdsys_workflow->toArray();
        $this->assertArrayHasKey('id', $createdsys_workflow);
        $this->assertNotNull($createdsys_workflow['id'], 'Created sys_workflow must have id specified');
        $this->assertNotNull(sys_workflow::find($createdsys_workflow['id']), 'sys_workflow with given id must be in DB');
        $this->assertModelData($sysWorkflow, $createdsys_workflow);
    }

    /**
     * @test read
     */
    public function test_read_sys_workflow()
    {
        $sysWorkflow = factory(sys_workflow::class)->create();

        $dbsys_workflow = $this->sysWorkflowRepo->find($sysWorkflow->id);

        $dbsys_workflow = $dbsys_workflow->toArray();
        $this->assertModelData($sysWorkflow->toArray(), $dbsys_workflow);
    }

    /**
     * @test update
     */
    public function test_update_sys_workflow()
    {
        $sysWorkflow = factory(sys_workflow::class)->create();
        $fakesys_workflow = factory(sys_workflow::class)->make()->toArray();

        $updatedsys_workflow = $this->sysWorkflowRepo->update($fakesys_workflow, $sysWorkflow->id);

        $this->assertModelData($fakesys_workflow, $updatedsys_workflow->toArray());
        $dbsys_workflow = $this->sysWorkflowRepo->find($sysWorkflow->id);
        $this->assertModelData($fakesys_workflow, $dbsys_workflow->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_sys_workflow()
    {
        $sysWorkflow = factory(sys_workflow::class)->create();

        $resp = $this->sysWorkflowRepo->delete($sysWorkflow->id);

        $this->assertTrue($resp);
        $this->assertNull(sys_workflow::find($sysWorkflow->id), 'sys_workflow should not exist in DB');
    }
}
