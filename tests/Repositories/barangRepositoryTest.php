<?php namespace Tests\Repositories;

use App\Models\barang;
use App\Repositories\barangRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class barangRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var barangRepository
     */
    protected $barangRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->barangRepo = \App::make(barangRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_barang()
    {
        $barang = factory(barang::class)->make()->toArray();

        $createdbarang = $this->barangRepo->create($barang);

        $createdbarang = $createdbarang->toArray();
        $this->assertArrayHasKey('id', $createdbarang);
        $this->assertNotNull($createdbarang['id'], 'Created barang must have id specified');
        $this->assertNotNull(barang::find($createdbarang['id']), 'barang with given id must be in DB');
        $this->assertModelData($barang, $createdbarang);
    }

    /**
     * @test read
     */
    public function test_read_barang()
    {
        $barang = factory(barang::class)->create();

        $dbbarang = $this->barangRepo->find($barang->id);

        $dbbarang = $dbbarang->toArray();
        $this->assertModelData($barang->toArray(), $dbbarang);
    }

    /**
     * @test update
     */
    public function test_update_barang()
    {
        $barang = factory(barang::class)->create();
        $fakebarang = factory(barang::class)->make()->toArray();

        $updatedbarang = $this->barangRepo->update($fakebarang, $barang->id);

        $this->assertModelData($fakebarang, $updatedbarang->toArray());
        $dbbarang = $this->barangRepo->find($barang->id);
        $this->assertModelData($fakebarang, $dbbarang->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_barang()
    {
        $barang = factory(barang::class)->create();

        $resp = $this->barangRepo->delete($barang->id);

        $this->assertTrue($resp);
        $this->assertNull(barang::find($barang->id), 'barang should not exist in DB');
    }
}
