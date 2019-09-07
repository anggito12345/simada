<?php namespace Tests\Repositories;

use App\Models\alamat;
use App\Repositories\alamatRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class alamatRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var alamatRepository
     */
    protected $alamatRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->alamatRepo = \App::make(alamatRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_alamat()
    {
        $alamat = factory(alamat::class)->make()->toArray();

        $createdalamat = $this->alamatRepo->create($alamat);

        $createdalamat = $createdalamat->toArray();
        $this->assertArrayHasKey('id', $createdalamat);
        $this->assertNotNull($createdalamat['id'], 'Created alamat must have id specified');
        $this->assertNotNull(alamat::find($createdalamat['id']), 'alamat with given id must be in DB');
        $this->assertModelData($alamat, $createdalamat);
    }

    /**
     * @test read
     */
    public function test_read_alamat()
    {
        $alamat = factory(alamat::class)->create();

        $dbalamat = $this->alamatRepo->find($alamat->id);

        $dbalamat = $dbalamat->toArray();
        $this->assertModelData($alamat->toArray(), $dbalamat);
    }

    /**
     * @test update
     */
    public function test_update_alamat()
    {
        $alamat = factory(alamat::class)->create();
        $fakealamat = factory(alamat::class)->make()->toArray();

        $updatedalamat = $this->alamatRepo->update($fakealamat, $alamat->id);

        $this->assertModelData($fakealamat, $updatedalamat->toArray());
        $dbalamat = $this->alamatRepo->find($alamat->id);
        $this->assertModelData($fakealamat, $dbalamat->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_alamat()
    {
        $alamat = factory(alamat::class)->create();

        $resp = $this->alamatRepo->delete($alamat->id);

        $this->assertTrue($resp);
        $this->assertNull(alamat::find($alamat->id), 'alamat should not exist in DB');
    }
}
