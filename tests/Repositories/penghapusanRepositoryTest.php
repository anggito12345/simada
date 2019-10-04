<?php namespace Tests\Repositories;

use App\Models\penghapusan;
use App\Repositories\penghapusanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class penghapusanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var penghapusanRepository
     */
    protected $penghapusanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->penghapusanRepo = \App::make(penghapusanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_penghapusan()
    {
        $penghapusan = factory(penghapusan::class)->make()->toArray();

        $createdpenghapusan = $this->penghapusanRepo->create($penghapusan);

        $createdpenghapusan = $createdpenghapusan->toArray();
        $this->assertArrayHasKey('id', $createdpenghapusan);
        $this->assertNotNull($createdpenghapusan['id'], 'Created penghapusan must have id specified');
        $this->assertNotNull(penghapusan::find($createdpenghapusan['id']), 'penghapusan with given id must be in DB');
        $this->assertModelData($penghapusan, $createdpenghapusan);
    }

    /**
     * @test read
     */
    public function test_read_penghapusan()
    {
        $penghapusan = factory(penghapusan::class)->create();

        $dbpenghapusan = $this->penghapusanRepo->find($penghapusan->id);

        $dbpenghapusan = $dbpenghapusan->toArray();
        $this->assertModelData($penghapusan->toArray(), $dbpenghapusan);
    }

    /**
     * @test update
     */
    public function test_update_penghapusan()
    {
        $penghapusan = factory(penghapusan::class)->create();
        $fakepenghapusan = factory(penghapusan::class)->make()->toArray();

        $updatedpenghapusan = $this->penghapusanRepo->update($fakepenghapusan, $penghapusan->id);

        $this->assertModelData($fakepenghapusan, $updatedpenghapusan->toArray());
        $dbpenghapusan = $this->penghapusanRepo->find($penghapusan->id);
        $this->assertModelData($fakepenghapusan, $dbpenghapusan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_penghapusan()
    {
        $penghapusan = factory(penghapusan::class)->create();

        $resp = $this->penghapusanRepo->delete($penghapusan->id);

        $this->assertTrue($resp);
        $this->assertNull(penghapusan::find($penghapusan->id), 'penghapusan should not exist in DB');
    }
}
