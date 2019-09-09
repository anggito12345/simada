<?php namespace Tests\Repositories;

use App\Models\detiljalan;
use App\Repositories\detiljalanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class detiljalanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var detiljalanRepository
     */
    protected $detiljalanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->detiljalanRepo = \App::make(detiljalanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_detiljalan()
    {
        $detiljalan = factory(detiljalan::class)->make()->toArray();

        $createddetiljalan = $this->detiljalanRepo->create($detiljalan);

        $createddetiljalan = $createddetiljalan->toArray();
        $this->assertArrayHasKey('id', $createddetiljalan);
        $this->assertNotNull($createddetiljalan['id'], 'Created detiljalan must have id specified');
        $this->assertNotNull(detiljalan::find($createddetiljalan['id']), 'detiljalan with given id must be in DB');
        $this->assertModelData($detiljalan, $createddetiljalan);
    }

    /**
     * @test read
     */
    public function test_read_detiljalan()
    {
        $detiljalan = factory(detiljalan::class)->create();

        $dbdetiljalan = $this->detiljalanRepo->find($detiljalan->id);

        $dbdetiljalan = $dbdetiljalan->toArray();
        $this->assertModelData($detiljalan->toArray(), $dbdetiljalan);
    }

    /**
     * @test update
     */
    public function test_update_detiljalan()
    {
        $detiljalan = factory(detiljalan::class)->create();
        $fakedetiljalan = factory(detiljalan::class)->make()->toArray();

        $updateddetiljalan = $this->detiljalanRepo->update($fakedetiljalan, $detiljalan->id);

        $this->assertModelData($fakedetiljalan, $updateddetiljalan->toArray());
        $dbdetiljalan = $this->detiljalanRepo->find($detiljalan->id);
        $this->assertModelData($fakedetiljalan, $dbdetiljalan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_detiljalan()
    {
        $detiljalan = factory(detiljalan::class)->create();

        $resp = $this->detiljalanRepo->delete($detiljalan->id);

        $this->assertTrue($resp);
        $this->assertNull(detiljalan::find($detiljalan->id), 'detiljalan should not exist in DB');
    }
}
