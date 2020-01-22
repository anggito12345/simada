<?php namespace Tests\Repositories;

use App\Models\reklas;
use App\Repositories\reklasRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class reklasRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var reklasRepository
     */
    protected $reklasRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->reklasRepo = \App::make(reklasRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_reklas()
    {
        $reklas = factory(reklas::class)->make()->toArray();

        $createdreklas = $this->reklasRepo->create($reklas);

        $createdreklas = $createdreklas->toArray();
        $this->assertArrayHasKey('id', $createdreklas);
        $this->assertNotNull($createdreklas['id'], 'Created reklas must have id specified');
        $this->assertNotNull(reklas::find($createdreklas['id']), 'reklas with given id must be in DB');
        $this->assertModelData($reklas, $createdreklas);
    }

    /**
     * @test read
     */
    public function test_read_reklas()
    {
        $reklas = factory(reklas::class)->create();

        $dbreklas = $this->reklasRepo->find($reklas->id);

        $dbreklas = $dbreklas->toArray();
        $this->assertModelData($reklas->toArray(), $dbreklas);
    }

    /**
     * @test update
     */
    public function test_update_reklas()
    {
        $reklas = factory(reklas::class)->create();
        $fakereklas = factory(reklas::class)->make()->toArray();

        $updatedreklas = $this->reklasRepo->update($fakereklas, $reklas->id);

        $this->assertModelData($fakereklas, $updatedreklas->toArray());
        $dbreklas = $this->reklasRepo->find($reklas->id);
        $this->assertModelData($fakereklas, $dbreklas->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_reklas()
    {
        $reklas = factory(reklas::class)->create();

        $resp = $this->reklasRepo->delete($reklas->id);

        $this->assertTrue($resp);
        $this->assertNull(reklas::find($reklas->id), 'reklas should not exist in DB');
    }
}
