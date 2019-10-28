<?php namespace Tests\Repositories;

use App\Models\mutasi;
use App\Repositories\mutasiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class mutasiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var mutasiRepository
     */
    protected $mutasiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mutasiRepo = \App::make(mutasiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_mutasi()
    {
        $mutasi = factory(mutasi::class)->make()->toArray();

        $createdmutasi = $this->mutasiRepo->create($mutasi);

        $createdmutasi = $createdmutasi->toArray();
        $this->assertArrayHasKey('id', $createdmutasi);
        $this->assertNotNull($createdmutasi['id'], 'Created mutasi must have id specified');
        $this->assertNotNull(mutasi::find($createdmutasi['id']), 'mutasi with given id must be in DB');
        $this->assertModelData($mutasi, $createdmutasi);
    }

    /**
     * @test read
     */
    public function test_read_mutasi()
    {
        $mutasi = factory(mutasi::class)->create();

        $dbmutasi = $this->mutasiRepo->find($mutasi->id);

        $dbmutasi = $dbmutasi->toArray();
        $this->assertModelData($mutasi->toArray(), $dbmutasi);
    }

    /**
     * @test update
     */
    public function test_update_mutasi()
    {
        $mutasi = factory(mutasi::class)->create();
        $fakemutasi = factory(mutasi::class)->make()->toArray();

        $updatedmutasi = $this->mutasiRepo->update($fakemutasi, $mutasi->id);

        $this->assertModelData($fakemutasi, $updatedmutasi->toArray());
        $dbmutasi = $this->mutasiRepo->find($mutasi->id);
        $this->assertModelData($fakemutasi, $dbmutasi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_mutasi()
    {
        $mutasi = factory(mutasi::class)->create();

        $resp = $this->mutasiRepo->delete($mutasi->id);

        $this->assertTrue($resp);
        $this->assertNull(mutasi::find($mutasi->id), 'mutasi should not exist in DB');
    }
}
