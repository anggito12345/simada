<?php namespace Tests\Repositories;

use App\Models\detilaset;
use App\Repositories\detilasetRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class detilasetRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var detilasetRepository
     */
    protected $detilasetRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->detilasetRepo = \App::make(detilasetRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_detilaset()
    {
        $detilaset = factory(detilaset::class)->make()->toArray();

        $createddetilaset = $this->detilasetRepo->create($detilaset);

        $createddetilaset = $createddetilaset->toArray();
        $this->assertArrayHasKey('id', $createddetilaset);
        $this->assertNotNull($createddetilaset['id'], 'Created detilaset must have id specified');
        $this->assertNotNull(detilaset::find($createddetilaset['id']), 'detilaset with given id must be in DB');
        $this->assertModelData($detilaset, $createddetilaset);
    }

    /**
     * @test read
     */
    public function test_read_detilaset()
    {
        $detilaset = factory(detilaset::class)->create();

        $dbdetilaset = $this->detilasetRepo->find($detilaset->id);

        $dbdetilaset = $dbdetilaset->toArray();
        $this->assertModelData($detilaset->toArray(), $dbdetilaset);
    }

    /**
     * @test update
     */
    public function test_update_detilaset()
    {
        $detilaset = factory(detilaset::class)->create();
        $fakedetilaset = factory(detilaset::class)->make()->toArray();

        $updateddetilaset = $this->detilasetRepo->update($fakedetilaset, $detilaset->id);

        $this->assertModelData($fakedetilaset, $updateddetilaset->toArray());
        $dbdetilaset = $this->detilasetRepo->find($detilaset->id);
        $this->assertModelData($fakedetilaset, $dbdetilaset->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_detilaset()
    {
        $detilaset = factory(detilaset::class)->create();

        $resp = $this->detilasetRepo->delete($detilaset->id);

        $this->assertTrue($resp);
        $this->assertNull(detilaset::find($detilaset->id), 'detilaset should not exist in DB');
    }
}
