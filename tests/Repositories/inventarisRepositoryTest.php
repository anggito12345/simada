<?php namespace Tests\Repositories;

use App\Models\inventaris;
use App\Repositories\inventarisRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class inventarisRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var inventarisRepository
     */
    protected $inventarisRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->inventarisRepo = \App::make(inventarisRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_inventaris()
    {
        $inventaris = factory(inventaris::class)->make()->toArray();

        $createdinventaris = $this->inventarisRepo->create($inventaris);

        $createdinventaris = $createdinventaris->toArray();
        $this->assertArrayHasKey('id', $createdinventaris);
        $this->assertNotNull($createdinventaris['id'], 'Created inventaris must have id specified');
        $this->assertNotNull(inventaris::find($createdinventaris['id']), 'inventaris with given id must be in DB');
        $this->assertModelData($inventaris, $createdinventaris);
    }

    /**
     * @test read
     */
    public function test_read_inventaris()
    {
        $inventaris = factory(inventaris::class)->create();

        $dbinventaris = $this->inventarisRepo->find($inventaris->id);

        $dbinventaris = $dbinventaris->toArray();
        $this->assertModelData($inventaris->toArray(), $dbinventaris);
    }

    /**
     * @test update
     */
    public function test_update_inventaris()
    {
        $inventaris = factory(inventaris::class)->create();
        $fakeinventaris = factory(inventaris::class)->make()->toArray();

        $updatedinventaris = $this->inventarisRepo->update($fakeinventaris, $inventaris->id);

        $this->assertModelData($fakeinventaris, $updatedinventaris->toArray());
        $dbinventaris = $this->inventarisRepo->find($inventaris->id);
        $this->assertModelData($fakeinventaris, $dbinventaris->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_inventaris()
    {
        $inventaris = factory(inventaris::class)->create();

        $resp = $this->inventarisRepo->delete($inventaris->id);

        $this->assertTrue($resp);
        $this->assertNull(inventaris::find($inventaris->id), 'inventaris should not exist in DB');
    }
}
