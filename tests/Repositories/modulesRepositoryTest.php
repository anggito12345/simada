<?php namespace Tests\Repositories;

use App\Models\modules;
use App\Repositories\modulesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class modulesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var modulesRepository
     */
    protected $modulesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->modulesRepo = \App::make(modulesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_modules()
    {
        $modules = factory(modules::class)->make()->toArray();

        $createdmodules = $this->modulesRepo->create($modules);

        $createdmodules = $createdmodules->toArray();
        $this->assertArrayHasKey('id', $createdmodules);
        $this->assertNotNull($createdmodules['id'], 'Created modules must have id specified');
        $this->assertNotNull(modules::find($createdmodules['id']), 'modules with given id must be in DB');
        $this->assertModelData($modules, $createdmodules);
    }

    /**
     * @test read
     */
    public function test_read_modules()
    {
        $modules = factory(modules::class)->create();

        $dbmodules = $this->modulesRepo->find($modules->id);

        $dbmodules = $dbmodules->toArray();
        $this->assertModelData($modules->toArray(), $dbmodules);
    }

    /**
     * @test update
     */
    public function test_update_modules()
    {
        $modules = factory(modules::class)->create();
        $fakemodules = factory(modules::class)->make()->toArray();

        $updatedmodules = $this->modulesRepo->update($fakemodules, $modules->id);

        $this->assertModelData($fakemodules, $updatedmodules->toArray());
        $dbmodules = $this->modulesRepo->find($modules->id);
        $this->assertModelData($fakemodules, $dbmodules->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_modules()
    {
        $modules = factory(modules::class)->create();

        $resp = $this->modulesRepo->delete($modules->id);

        $this->assertTrue($resp);
        $this->assertNull(modules::find($modules->id), 'modules should not exist in DB');
    }
}
