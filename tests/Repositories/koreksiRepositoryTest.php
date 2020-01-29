<?php namespace Tests\Repositories;

use App\Models\koreksi;
use App\Repositories\koreksiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class koreksiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var koreksiRepository
     */
    protected $koreksiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->koreksiRepo = \App::make(koreksiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_koreksi()
    {
        $koreksi = factory(koreksi::class)->make()->toArray();

        $createdkoreksi = $this->koreksiRepo->create($koreksi);

        $createdkoreksi = $createdkoreksi->toArray();
        $this->assertArrayHasKey('id', $createdkoreksi);
        $this->assertNotNull($createdkoreksi['id'], 'Created koreksi must have id specified');
        $this->assertNotNull(koreksi::find($createdkoreksi['id']), 'koreksi with given id must be in DB');
        $this->assertModelData($koreksi, $createdkoreksi);
    }

    /**
     * @test read
     */
    public function test_read_koreksi()
    {
        $koreksi = factory(koreksi::class)->create();

        $dbkoreksi = $this->koreksiRepo->find($koreksi->id);

        $dbkoreksi = $dbkoreksi->toArray();
        $this->assertModelData($koreksi->toArray(), $dbkoreksi);
    }

    /**
     * @test update
     */
    public function test_update_koreksi()
    {
        $koreksi = factory(koreksi::class)->create();
        $fakekoreksi = factory(koreksi::class)->make()->toArray();

        $updatedkoreksi = $this->koreksiRepo->update($fakekoreksi, $koreksi->id);

        $this->assertModelData($fakekoreksi, $updatedkoreksi->toArray());
        $dbkoreksi = $this->koreksiRepo->find($koreksi->id);
        $this->assertModelData($fakekoreksi, $dbkoreksi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_koreksi()
    {
        $koreksi = factory(koreksi::class)->create();

        $resp = $this->koreksiRepo->delete($koreksi->id);

        $this->assertTrue($resp);
        $this->assertNull(koreksi::find($koreksi->id), 'koreksi should not exist in DB');
    }
}
