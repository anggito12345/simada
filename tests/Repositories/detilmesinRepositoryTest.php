<?php namespace Tests\Repositories;

use App\Models\detilmesin;
use App\Repositories\detilmesinRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class detilmesinRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var detilmesinRepository
     */
    protected $detilmesinRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->detilmesinRepo = \App::make(detilmesinRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_detilmesin()
    {
        $detilmesin = factory(detilmesin::class)->make()->toArray();

        $createddetilmesin = $this->detilmesinRepo->create($detilmesin);

        $createddetilmesin = $createddetilmesin->toArray();
        $this->assertArrayHasKey('id', $createddetilmesin);
        $this->assertNotNull($createddetilmesin['id'], 'Created detilmesin must have id specified');
        $this->assertNotNull(detilmesin::find($createddetilmesin['id']), 'detilmesin with given id must be in DB');
        $this->assertModelData($detilmesin, $createddetilmesin);
    }

    /**
     * @test read
     */
    public function test_read_detilmesin()
    {
        $detilmesin = factory(detilmesin::class)->create();

        $dbdetilmesin = $this->detilmesinRepo->find($detilmesin->id);

        $dbdetilmesin = $dbdetilmesin->toArray();
        $this->assertModelData($detilmesin->toArray(), $dbdetilmesin);
    }

    /**
     * @test update
     */
    public function test_update_detilmesin()
    {
        $detilmesin = factory(detilmesin::class)->create();
        $fakedetilmesin = factory(detilmesin::class)->make()->toArray();

        $updateddetilmesin = $this->detilmesinRepo->update($fakedetilmesin, $detilmesin->id);

        $this->assertModelData($fakedetilmesin, $updateddetilmesin->toArray());
        $dbdetilmesin = $this->detilmesinRepo->find($detilmesin->id);
        $this->assertModelData($fakedetilmesin, $dbdetilmesin->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_detilmesin()
    {
        $detilmesin = factory(detilmesin::class)->create();

        $resp = $this->detilmesinRepo->delete($detilmesin->id);

        $this->assertTrue($resp);
        $this->assertNull(detilmesin::find($detilmesin->id), 'detilmesin should not exist in DB');
    }
}
