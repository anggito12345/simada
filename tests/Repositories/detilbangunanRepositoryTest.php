<?php namespace Tests\Repositories;

use App\Models\detilbangunan;
use App\Repositories\detilbangunanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class detilbangunanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var detilbangunanRepository
     */
    protected $detilbangunanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->detilbangunanRepo = \App::make(detilbangunanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_detilbangunan()
    {
        $detilbangunan = factory(detilbangunan::class)->make()->toArray();

        $createddetilbangunan = $this->detilbangunanRepo->create($detilbangunan);

        $createddetilbangunan = $createddetilbangunan->toArray();
        $this->assertArrayHasKey('id', $createddetilbangunan);
        $this->assertNotNull($createddetilbangunan['id'], 'Created detilbangunan must have id specified');
        $this->assertNotNull(detilbangunan::find($createddetilbangunan['id']), 'detilbangunan with given id must be in DB');
        $this->assertModelData($detilbangunan, $createddetilbangunan);
    }

    /**
     * @test read
     */
    public function test_read_detilbangunan()
    {
        $detilbangunan = factory(detilbangunan::class)->create();

        $dbdetilbangunan = $this->detilbangunanRepo->find($detilbangunan->id);

        $dbdetilbangunan = $dbdetilbangunan->toArray();
        $this->assertModelData($detilbangunan->toArray(), $dbdetilbangunan);
    }

    /**
     * @test update
     */
    public function test_update_detilbangunan()
    {
        $detilbangunan = factory(detilbangunan::class)->create();
        $fakedetilbangunan = factory(detilbangunan::class)->make()->toArray();

        $updateddetilbangunan = $this->detilbangunanRepo->update($fakedetilbangunan, $detilbangunan->id);

        $this->assertModelData($fakedetilbangunan, $updateddetilbangunan->toArray());
        $dbdetilbangunan = $this->detilbangunanRepo->find($detilbangunan->id);
        $this->assertModelData($fakedetilbangunan, $dbdetilbangunan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_detilbangunan()
    {
        $detilbangunan = factory(detilbangunan::class)->create();

        $resp = $this->detilbangunanRepo->delete($detilbangunan->id);

        $this->assertTrue($resp);
        $this->assertNull(detilbangunan::find($detilbangunan->id), 'detilbangunan should not exist in DB');
    }
}
