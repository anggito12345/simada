<?php namespace Tests\Repositories;

use App\Models\sys_workflow_master;
use App\Repositories\sys_workflow_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class sys_workflow_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var sys_workflow_masterRepository
     */
    protected $sysWorkflowMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->sysWorkflowMasterRepo = \App::make(sys_workflow_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_sys_workflow_master()
    {
        $sysWorkflowMaster = factory(sys_workflow_master::class)->make()->toArray();

        $createdsys_workflow_master = $this->sysWorkflowMasterRepo->create($sysWorkflowMaster);

        $createdsys_workflow_master = $createdsys_workflow_master->toArray();
        $this->assertArrayHasKey('id', $createdsys_workflow_master);
        $this->assertNotNull($createdsys_workflow_master['id'], 'Created sys_workflow_master must have id specified');
        $this->assertNotNull(sys_workflow_master::find($createdsys_workflow_master['id']), 'sys_workflow_master with given id must be in DB');
        $this->assertModelData($sysWorkflowMaster, $createdsys_workflow_master);
    }

    /**
     * @test read
     */
    public function test_read_sys_workflow_master()
    {
        $sysWorkflowMaster = factory(sys_workflow_master::class)->create();

        $dbsys_workflow_master = $this->sysWorkflowMasterRepo->find($sysWorkflowMaster->id);

        $dbsys_workflow_master = $dbsys_workflow_master->toArray();
        $this->assertModelData($sysWorkflowMaster->toArray(), $dbsys_workflow_master);
    }

    /**
     * @test update
     */
    public function test_update_sys_workflow_master()
    {
        $sysWorkflowMaster = factory(sys_workflow_master::class)->create();
        $fakesys_workflow_master = factory(sys_workflow_master::class)->make()->toArray();

        $updatedsys_workflow_master = $this->sysWorkflowMasterRepo->update($fakesys_workflow_master, $sysWorkflowMaster->id);

        $this->assertModelData($fakesys_workflow_master, $updatedsys_workflow_master->toArray());
        $dbsys_workflow_master = $this->sysWorkflowMasterRepo->find($sysWorkflowMaster->id);
        $this->assertModelData($fakesys_workflow_master, $dbsys_workflow_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_sys_workflow_master()
    {
        $sysWorkflowMaster = factory(sys_workflow_master::class)->create();

        $resp = $this->sysWorkflowMasterRepo->delete($sysWorkflowMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(sys_workflow_master::find($sysWorkflowMaster->id), 'sys_workflow_master should not exist in DB');
    }
}
