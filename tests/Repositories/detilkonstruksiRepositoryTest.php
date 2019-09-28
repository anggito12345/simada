<?php namespace Tests\Repositories;

use App\Models\detilkonstruksi;
use App\Repositories\detilkonstruksiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class detilkonstruksiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var detilkonstruksiRepository
     */
    protected $detilkonstruksiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->detilkonstruksiRepo = \App::make(detilkonstruksiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_detilkonstruksi()
    {
        $detilkonstruksi = factory(detilkonstruksi::class)->make()->toArray();

        $createddetilkonstruksi = $this->detilkonstruksiRepo->create($detilkonstruksi);

        $createddetilkonstruksi = $createddetilkonstruksi->toArray();
        $this->assertArrayHasKey('id', $createddetilkonstruksi);
        $this->assertNotNull($createddetilkonstruksi['id'], 'Created detilkonstruksi must have id specified');
        $this->assertNotNull(detilkonstruksi::find($createddetilkonstruksi['id']), 'detilkonstruksi with given id must be in DB');
        $this->assertModelData($detilkonstruksi, $createddetilkonstruksi);
    }

    /**
     * @test read
     */
    public function test_read_detilkonstruksi()
    {
        $detilkonstruksi = factory(detilkonstruksi::class)->create();

        $dbdetilkonstruksi = $this->detilkonstruksiRepo->find($detilkonstruksi->id);

        $dbdetilkonstruksi = $dbdetilkonstruksi->toArray();
        $this->assertModelData($detilkonstruksi->toArray(), $dbdetilkonstruksi);
    }

    /**
     * @test update
     */
    public function test_update_detilkonstruksi()
    {
        $detilkonstruksi = factory(detilkonstruksi::class)->create();
        $fakedetilkonstruksi = factory(detilkonstruksi::class)->make()->toArray();

        $updateddetilkonstruksi = $this->detilkonstruksiRepo->update($fakedetilkonstruksi, $detilkonstruksi->id);

        $this->assertModelData($fakedetilkonstruksi, $updateddetilkonstruksi->toArray());
        $dbdetilkonstruksi = $this->detilkonstruksiRepo->find($detilkonstruksi->id);
        $this->assertModelData($fakedetilkonstruksi, $dbdetilkonstruksi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_detilkonstruksi()
    {
        $detilkonstruksi = factory(detilkonstruksi::class)->create();

        $resp = $this->detilkonstruksiRepo->delete($detilkonstruksi->id);

        $this->assertTrue($resp);
        $this->assertNull(detilkonstruksi::find($detilkonstruksi->id), 'detilkonstruksi should not exist in DB');
    }
}
