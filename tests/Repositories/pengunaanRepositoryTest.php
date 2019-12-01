<?php namespace Tests\Repositories;

use App\Models\pengunaan;
use App\Repositories\pengunaanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class pengunaanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var pengunaanRepository
     */
    protected $pengunaanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pengunaanRepo = \App::make(pengunaanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_pengunaan()
    {
        $pengunaan = factory(pengunaan::class)->make()->toArray();

        $createdpengunaan = $this->pengunaanRepo->create($pengunaan);

        $createdpengunaan = $createdpengunaan->toArray();
        $this->assertArrayHasKey('id', $createdpengunaan);
        $this->assertNotNull($createdpengunaan['id'], 'Created pengunaan must have id specified');
        $this->assertNotNull(pengunaan::find($createdpengunaan['id']), 'pengunaan with given id must be in DB');
        $this->assertModelData($pengunaan, $createdpengunaan);
    }

    /**
     * @test read
     */
    public function test_read_pengunaan()
    {
        $pengunaan = factory(pengunaan::class)->create();

        $dbpengunaan = $this->pengunaanRepo->find($pengunaan->id);

        $dbpengunaan = $dbpengunaan->toArray();
        $this->assertModelData($pengunaan->toArray(), $dbpengunaan);
    }

    /**
     * @test update
     */
    public function test_update_pengunaan()
    {
        $pengunaan = factory(pengunaan::class)->create();
        $fakepengunaan = factory(pengunaan::class)->make()->toArray();

        $updatedpengunaan = $this->pengunaanRepo->update($fakepengunaan, $pengunaan->id);

        $this->assertModelData($fakepengunaan, $updatedpengunaan->toArray());
        $dbpengunaan = $this->pengunaanRepo->find($pengunaan->id);
        $this->assertModelData($fakepengunaan, $dbpengunaan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_pengunaan()
    {
        $pengunaan = factory(pengunaan::class)->create();

        $resp = $this->pengunaanRepo->delete($pengunaan->id);

        $this->assertTrue($resp);
        $this->assertNull(pengunaan::find($pengunaan->id), 'pengunaan should not exist in DB');
    }
}
