<?php namespace Tests\Repositories;

use App\Models\mutasi_detil;
use App\Repositories\mutasi_detilRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class mutasi_detilRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var mutasi_detilRepository
     */
    protected $mutasiDetilRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mutasiDetilRepo = \App::make(mutasi_detilRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_mutasi_detil()
    {
        $mutasiDetil = factory(mutasi_detil::class)->make()->toArray();

        $createdmutasi_detil = $this->mutasiDetilRepo->create($mutasiDetil);

        $createdmutasi_detil = $createdmutasi_detil->toArray();
        $this->assertArrayHasKey('id', $createdmutasi_detil);
        $this->assertNotNull($createdmutasi_detil['id'], 'Created mutasi_detil must have id specified');
        $this->assertNotNull(mutasi_detil::find($createdmutasi_detil['id']), 'mutasi_detil with given id must be in DB');
        $this->assertModelData($mutasiDetil, $createdmutasi_detil);
    }

    /**
     * @test read
     */
    public function test_read_mutasi_detil()
    {
        $mutasiDetil = factory(mutasi_detil::class)->create();

        $dbmutasi_detil = $this->mutasiDetilRepo->find($mutasiDetil->id);

        $dbmutasi_detil = $dbmutasi_detil->toArray();
        $this->assertModelData($mutasiDetil->toArray(), $dbmutasi_detil);
    }

    /**
     * @test update
     */
    public function test_update_mutasi_detil()
    {
        $mutasiDetil = factory(mutasi_detil::class)->create();
        $fakemutasi_detil = factory(mutasi_detil::class)->make()->toArray();

        $updatedmutasi_detil = $this->mutasiDetilRepo->update($fakemutasi_detil, $mutasiDetil->id);

        $this->assertModelData($fakemutasi_detil, $updatedmutasi_detil->toArray());
        $dbmutasi_detil = $this->mutasiDetilRepo->find($mutasiDetil->id);
        $this->assertModelData($fakemutasi_detil, $dbmutasi_detil->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_mutasi_detil()
    {
        $mutasiDetil = factory(mutasi_detil::class)->create();

        $resp = $this->mutasiDetilRepo->delete($mutasiDetil->id);

        $this->assertTrue($resp);
        $this->assertNull(mutasi_detil::find($mutasiDetil->id), 'mutasi_detil should not exist in DB');
    }
}
