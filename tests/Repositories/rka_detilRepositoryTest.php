<?php namespace Tests\Repositories;

use App\Models\rka_detil;
use App\Repositories\rka_detilRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class rka_detilRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var rka_detilRepository
     */
    protected $rkaDetilRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rkaDetilRepo = \App::make(rka_detilRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rka_detil()
    {
        $rkaDetil = factory(rka_detil::class)->make()->toArray();

        $createdrka_detil = $this->rkaDetilRepo->create($rkaDetil);

        $createdrka_detil = $createdrka_detil->toArray();
        $this->assertArrayHasKey('id', $createdrka_detil);
        $this->assertNotNull($createdrka_detil['id'], 'Created rka_detil must have id specified');
        $this->assertNotNull(rka_detil::find($createdrka_detil['id']), 'rka_detil with given id must be in DB');
        $this->assertModelData($rkaDetil, $createdrka_detil);
    }

    /**
     * @test read
     */
    public function test_read_rka_detil()
    {
        $rkaDetil = factory(rka_detil::class)->create();

        $dbrka_detil = $this->rkaDetilRepo->find($rkaDetil->id);

        $dbrka_detil = $dbrka_detil->toArray();
        $this->assertModelData($rkaDetil->toArray(), $dbrka_detil);
    }

    /**
     * @test update
     */
    public function test_update_rka_detil()
    {
        $rkaDetil = factory(rka_detil::class)->create();
        $fakerka_detil = factory(rka_detil::class)->make()->toArray();

        $updatedrka_detil = $this->rkaDetilRepo->update($fakerka_detil, $rkaDetil->id);

        $this->assertModelData($fakerka_detil, $updatedrka_detil->toArray());
        $dbrka_detil = $this->rkaDetilRepo->find($rkaDetil->id);
        $this->assertModelData($fakerka_detil, $dbrka_detil->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rka_detil()
    {
        $rkaDetil = factory(rka_detil::class)->create();

        $resp = $this->rkaDetilRepo->delete($rkaDetil->id);

        $this->assertTrue($resp);
        $this->assertNull(rka_detil::find($rkaDetil->id), 'rka_detil should not exist in DB');
    }
}
