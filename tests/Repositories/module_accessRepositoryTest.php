<?php namespace Tests\Repositories;

use App\Models\module_access;
use App\Repositories\module_accessRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class module_accessRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var module_accessRepository
     */
    protected $moduleAccessRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->moduleAccessRepo = \App::make(module_accessRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_module_access()
    {
        $moduleAccess = factory(module_access::class)->make()->toArray();

        $createdmodule_access = $this->moduleAccessRepo->create($moduleAccess);

        $createdmodule_access = $createdmodule_access->toArray();
        $this->assertArrayHasKey('id', $createdmodule_access);
        $this->assertNotNull($createdmodule_access['id'], 'Created module_access must have id specified');
        $this->assertNotNull(module_access::find($createdmodule_access['id']), 'module_access with given id must be in DB');
        $this->assertModelData($moduleAccess, $createdmodule_access);
    }

    /**
     * @test read
     */
    public function test_read_module_access()
    {
        $moduleAccess = factory(module_access::class)->create();

        $dbmodule_access = $this->moduleAccessRepo->find($moduleAccess->id);

        $dbmodule_access = $dbmodule_access->toArray();
        $this->assertModelData($moduleAccess->toArray(), $dbmodule_access);
    }

    /**
     * @test update
     */
    public function test_update_module_access()
    {
        $moduleAccess = factory(module_access::class)->create();
        $fakemodule_access = factory(module_access::class)->make()->toArray();

        $updatedmodule_access = $this->moduleAccessRepo->update($fakemodule_access, $moduleAccess->id);

        $this->assertModelData($fakemodule_access, $updatedmodule_access->toArray());
        $dbmodule_access = $this->moduleAccessRepo->find($moduleAccess->id);
        $this->assertModelData($fakemodule_access, $dbmodule_access->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_module_access()
    {
        $moduleAccess = factory(module_access::class)->create();

        $resp = $this->moduleAccessRepo->delete($moduleAccess->id);

        $this->assertTrue($resp);
        $this->assertNull(module_access::find($moduleAccess->id), 'module_access should not exist in DB');
    }
}
