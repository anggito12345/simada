<?php namespace Tests\Repositories;

use App\Models\satuanbarang;
use App\Repositories\satuanbarangRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class satuanbarangRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var satuanbarangRepository
     */
    protected $satuanbarangRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->satuanbarangRepo = \App::make(satuanbarangRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_satuanbarang()
    {
        $satuanbarang = factory(satuanbarang::class)->make()->toArray();

        $createdsatuanbarang = $this->satuanbarangRepo->create($satuanbarang);

        $createdsatuanbarang = $createdsatuanbarang->toArray();
        $this->assertArrayHasKey('id', $createdsatuanbarang);
        $this->assertNotNull($createdsatuanbarang['id'], 'Created satuanbarang must have id specified');
        $this->assertNotNull(satuanbarang::find($createdsatuanbarang['id']), 'satuanbarang with given id must be in DB');
        $this->assertModelData($satuanbarang, $createdsatuanbarang);
    }

    /**
     * @test read
     */
    public function test_read_satuanbarang()
    {
        $satuanbarang = factory(satuanbarang::class)->create();

        $dbsatuanbarang = $this->satuanbarangRepo->find($satuanbarang->id);

        $dbsatuanbarang = $dbsatuanbarang->toArray();
        $this->assertModelData($satuanbarang->toArray(), $dbsatuanbarang);
    }

    /**
     * @test update
     */
    public function test_update_satuanbarang()
    {
        $satuanbarang = factory(satuanbarang::class)->create();
        $fakesatuanbarang = factory(satuanbarang::class)->make()->toArray();

        $updatedsatuanbarang = $this->satuanbarangRepo->update($fakesatuanbarang, $satuanbarang->id);

        $this->assertModelData($fakesatuanbarang, $updatedsatuanbarang->toArray());
        $dbsatuanbarang = $this->satuanbarangRepo->find($satuanbarang->id);
        $this->assertModelData($fakesatuanbarang, $dbsatuanbarang->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_satuanbarang()
    {
        $satuanbarang = factory(satuanbarang::class)->create();

        $resp = $this->satuanbarangRepo->delete($satuanbarang->id);

        $this->assertTrue($resp);
        $this->assertNull(satuanbarang::find($satuanbarang->id), 'satuanbarang should not exist in DB');
    }
}
