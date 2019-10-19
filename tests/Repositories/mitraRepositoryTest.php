<?php namespace Tests\Repositories;

use App\Models\mitra;
use App\Repositories\mitraRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class mitraRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var mitraRepository
     */
    protected $mitraRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mitraRepo = \App::make(mitraRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_mitra()
    {
        $mitra = factory(mitra::class)->make()->toArray();

        $createdmitra = $this->mitraRepo->create($mitra);

        $createdmitra = $createdmitra->toArray();
        $this->assertArrayHasKey('id', $createdmitra);
        $this->assertNotNull($createdmitra['id'], 'Created mitra must have id specified');
        $this->assertNotNull(mitra::find($createdmitra['id']), 'mitra with given id must be in DB');
        $this->assertModelData($mitra, $createdmitra);
    }

    /**
     * @test read
     */
    public function test_read_mitra()
    {
        $mitra = factory(mitra::class)->create();

        $dbmitra = $this->mitraRepo->find($mitra->id);

        $dbmitra = $dbmitra->toArray();
        $this->assertModelData($mitra->toArray(), $dbmitra);
    }

    /**
     * @test update
     */
    public function test_update_mitra()
    {
        $mitra = factory(mitra::class)->create();
        $fakemitra = factory(mitra::class)->make()->toArray();

        $updatedmitra = $this->mitraRepo->update($fakemitra, $mitra->id);

        $this->assertModelData($fakemitra, $updatedmitra->toArray());
        $dbmitra = $this->mitraRepo->find($mitra->id);
        $this->assertModelData($fakemitra, $dbmitra->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_mitra()
    {
        $mitra = factory(mitra::class)->create();

        $resp = $this->mitraRepo->delete($mitra->id);

        $this->assertTrue($resp);
        $this->assertNull(mitra::find($mitra->id), 'mitra should not exist in DB');
    }
}
