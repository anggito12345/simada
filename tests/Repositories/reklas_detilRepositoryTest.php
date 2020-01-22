<?php namespace Tests\Repositories;

use App\Models\reklas_detil;
use App\Repositories\reklas_detilRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class reklas_detilRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var reklas_detilRepository
     */
    protected $reklasDetilRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->reklasDetilRepo = \App::make(reklas_detilRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_reklas_detil()
    {
        $reklasDetil = factory(reklas_detil::class)->make()->toArray();

        $createdreklas_detil = $this->reklasDetilRepo->create($reklasDetil);

        $createdreklas_detil = $createdreklas_detil->toArray();
        $this->assertArrayHasKey('id', $createdreklas_detil);
        $this->assertNotNull($createdreklas_detil['id'], 'Created reklas_detil must have id specified');
        $this->assertNotNull(reklas_detil::find($createdreklas_detil['id']), 'reklas_detil with given id must be in DB');
        $this->assertModelData($reklasDetil, $createdreklas_detil);
    }

    /**
     * @test read
     */
    public function test_read_reklas_detil()
    {
        $reklasDetil = factory(reklas_detil::class)->create();

        $dbreklas_detil = $this->reklasDetilRepo->find($reklasDetil->id);

        $dbreklas_detil = $dbreklas_detil->toArray();
        $this->assertModelData($reklasDetil->toArray(), $dbreklas_detil);
    }

    /**
     * @test update
     */
    public function test_update_reklas_detil()
    {
        $reklasDetil = factory(reklas_detil::class)->create();
        $fakereklas_detil = factory(reklas_detil::class)->make()->toArray();

        $updatedreklas_detil = $this->reklasDetilRepo->update($fakereklas_detil, $reklasDetil->id);

        $this->assertModelData($fakereklas_detil, $updatedreklas_detil->toArray());
        $dbreklas_detil = $this->reklasDetilRepo->find($reklasDetil->id);
        $this->assertModelData($fakereklas_detil, $dbreklas_detil->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_reklas_detil()
    {
        $reklasDetil = factory(reklas_detil::class)->create();

        $resp = $this->reklasDetilRepo->delete($reklasDetil->id);

        $this->assertTrue($resp);
        $this->assertNull(reklas_detil::find($reklasDetil->id), 'reklas_detil should not exist in DB');
    }
}
