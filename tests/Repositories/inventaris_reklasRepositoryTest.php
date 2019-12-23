<?php namespace Tests\Repositories;

use App\Models\inventaris_reklas;
use App\Repositories\inventaris_reklasRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class inventaris_reklasRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var inventaris_reklasRepository
     */
    protected $inventarisReklasRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->inventarisReklasRepo = \App::make(inventaris_reklasRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_inventaris_reklas()
    {
        $inventarisReklas = factory(inventaris_reklas::class)->make()->toArray();

        $createdinventaris_reklas = $this->inventarisReklasRepo->create($inventarisReklas);

        $createdinventaris_reklas = $createdinventaris_reklas->toArray();
        $this->assertArrayHasKey('id', $createdinventaris_reklas);
        $this->assertNotNull($createdinventaris_reklas['id'], 'Created inventaris_reklas must have id specified');
        $this->assertNotNull(inventaris_reklas::find($createdinventaris_reklas['id']), 'inventaris_reklas with given id must be in DB');
        $this->assertModelData($inventarisReklas, $createdinventaris_reklas);
    }

    /**
     * @test read
     */
    public function test_read_inventaris_reklas()
    {
        $inventarisReklas = factory(inventaris_reklas::class)->create();

        $dbinventaris_reklas = $this->inventarisReklasRepo->find($inventarisReklas->id);

        $dbinventaris_reklas = $dbinventaris_reklas->toArray();
        $this->assertModelData($inventarisReklas->toArray(), $dbinventaris_reklas);
    }

    /**
     * @test update
     */
    public function test_update_inventaris_reklas()
    {
        $inventarisReklas = factory(inventaris_reklas::class)->create();
        $fakeinventaris_reklas = factory(inventaris_reklas::class)->make()->toArray();

        $updatedinventaris_reklas = $this->inventarisReklasRepo->update($fakeinventaris_reklas, $inventarisReklas->id);

        $this->assertModelData($fakeinventaris_reklas, $updatedinventaris_reklas->toArray());
        $dbinventaris_reklas = $this->inventarisReklasRepo->find($inventarisReklas->id);
        $this->assertModelData($fakeinventaris_reklas, $dbinventaris_reklas->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_inventaris_reklas()
    {
        $inventarisReklas = factory(inventaris_reklas::class)->create();

        $resp = $this->inventarisReklasRepo->delete($inventarisReklas->id);

        $this->assertTrue($resp);
        $this->assertNull(inventaris_reklas::find($inventarisReklas->id), 'inventaris_reklas should not exist in DB');
    }
}
