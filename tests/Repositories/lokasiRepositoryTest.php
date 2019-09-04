<?php namespace Tests\Repositories;

use App\Models\lokasi;
use App\Repositories\lokasiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class lokasiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var lokasiRepository
     */
    protected $lokasiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->lokasiRepo = \App::make(lokasiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_lokasi()
    {
        $lokasi = factory(lokasi::class)->make()->toArray();

        $createdlokasi = $this->lokasiRepo->create($lokasi);

        $createdlokasi = $createdlokasi->toArray();
        $this->assertArrayHasKey('id', $createdlokasi);
        $this->assertNotNull($createdlokasi['id'], 'Created lokasi must have id specified');
        $this->assertNotNull(lokasi::find($createdlokasi['id']), 'lokasi with given id must be in DB');
        $this->assertModelData($lokasi, $createdlokasi);
    }

    /**
     * @test read
     */
    public function test_read_lokasi()
    {
        $lokasi = factory(lokasi::class)->create();

        $dblokasi = $this->lokasiRepo->find($lokasi->id);

        $dblokasi = $dblokasi->toArray();
        $this->assertModelData($lokasi->toArray(), $dblokasi);
    }

    /**
     * @test update
     */
    public function test_update_lokasi()
    {
        $lokasi = factory(lokasi::class)->create();
        $fakelokasi = factory(lokasi::class)->make()->toArray();

        $updatedlokasi = $this->lokasiRepo->update($fakelokasi, $lokasi->id);

        $this->assertModelData($fakelokasi, $updatedlokasi->toArray());
        $dblokasi = $this->lokasiRepo->find($lokasi->id);
        $this->assertModelData($fakelokasi, $dblokasi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_lokasi()
    {
        $lokasi = factory(lokasi::class)->create();

        $resp = $this->lokasiRepo->delete($lokasi->id);

        $this->assertTrue($resp);
        $this->assertNull(lokasi::find($lokasi->id), 'lokasi should not exist in DB');
    }
}
