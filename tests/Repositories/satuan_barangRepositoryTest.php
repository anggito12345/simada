<?php namespace Tests\Repositories;

use App\Models\satuan_barang;
use App\Repositories\satuan_barangRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class satuan_barangRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var satuan_barangRepository
     */
    protected $satuanBarangRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->satuanBarangRepo = \App::make(satuan_barangRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_satuan_barang()
    {
        $satuanBarang = factory(satuan_barang::class)->make()->toArray();

        $createdsatuan_barang = $this->satuanBarangRepo->create($satuanBarang);

        $createdsatuan_barang = $createdsatuan_barang->toArray();
        $this->assertArrayHasKey('id', $createdsatuan_barang);
        $this->assertNotNull($createdsatuan_barang['id'], 'Created satuan_barang must have id specified');
        $this->assertNotNull(satuan_barang::find($createdsatuan_barang['id']), 'satuan_barang with given id must be in DB');
        $this->assertModelData($satuanBarang, $createdsatuan_barang);
    }

    /**
     * @test read
     */
    public function test_read_satuan_barang()
    {
        $satuanBarang = factory(satuan_barang::class)->create();

        $dbsatuan_barang = $this->satuanBarangRepo->find($satuanBarang->id);

        $dbsatuan_barang = $dbsatuan_barang->toArray();
        $this->assertModelData($satuanBarang->toArray(), $dbsatuan_barang);
    }

    /**
     * @test update
     */
    public function test_update_satuan_barang()
    {
        $satuanBarang = factory(satuan_barang::class)->create();
        $fakesatuan_barang = factory(satuan_barang::class)->make()->toArray();

        $updatedsatuan_barang = $this->satuanBarangRepo->update($fakesatuan_barang, $satuanBarang->id);

        $this->assertModelData($fakesatuan_barang, $updatedsatuan_barang->toArray());
        $dbsatuan_barang = $this->satuanBarangRepo->find($satuanBarang->id);
        $this->assertModelData($fakesatuan_barang, $dbsatuan_barang->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_satuan_barang()
    {
        $satuanBarang = factory(satuan_barang::class)->create();

        $resp = $this->satuanBarangRepo->delete($satuanBarang->id);

        $this->assertTrue($resp);
        $this->assertNull(satuan_barang::find($satuanBarang->id), 'satuan_barang should not exist in DB');
    }
}
