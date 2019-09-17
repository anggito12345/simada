<?php namespace Tests\Repositories;

use App\Models\organisasi;
use App\Repositories\organisasiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class organisasiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var organisasiRepository
     */
    protected $organisasiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->organisasiRepo = \App::make(organisasiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_organisasi()
    {
        $organisasi = factory(organisasi::class)->make()->toArray();

        $createdorganisasi = $this->organisasiRepo->create($organisasi);

        $createdorganisasi = $createdorganisasi->toArray();
        $this->assertArrayHasKey('id', $createdorganisasi);
        $this->assertNotNull($createdorganisasi['id'], 'Created organisasi must have id specified');
        $this->assertNotNull(organisasi::find($createdorganisasi['id']), 'organisasi with given id must be in DB');
        $this->assertModelData($organisasi, $createdorganisasi);
    }

    /**
     * @test read
     */
    public function test_read_organisasi()
    {
        $organisasi = factory(organisasi::class)->create();

        $dborganisasi = $this->organisasiRepo->find($organisasi->id);

        $dborganisasi = $dborganisasi->toArray();
        $this->assertModelData($organisasi->toArray(), $dborganisasi);
    }

    /**
     * @test update
     */
    public function test_update_organisasi()
    {
        $organisasi = factory(organisasi::class)->create();
        $fakeorganisasi = factory(organisasi::class)->make()->toArray();

        $updatedorganisasi = $this->organisasiRepo->update($fakeorganisasi, $organisasi->id);

        $this->assertModelData($fakeorganisasi, $updatedorganisasi->toArray());
        $dborganisasi = $this->organisasiRepo->find($organisasi->id);
        $this->assertModelData($fakeorganisasi, $dborganisasi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_organisasi()
    {
        $organisasi = factory(organisasi::class)->create();

        $resp = $this->organisasiRepo->delete($organisasi->id);

        $this->assertTrue($resp);
        $this->assertNull(organisasi::find($organisasi->id), 'organisasi should not exist in DB');
    }
}
