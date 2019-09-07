<?php namespace Tests\Repositories;

use App\Models\jenisbarang;
use App\Repositories\jenisbarangRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class jenisbarangRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var jenisbarangRepository
     */
    protected $jenisbarangRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->jenisbarangRepo = \App::make(jenisbarangRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_jenisbarang()
    {
        $jenisbarang = factory(jenisbarang::class)->make()->toArray();

        $createdjenisbarang = $this->jenisbarangRepo->create($jenisbarang);

        $createdjenisbarang = $createdjenisbarang->toArray();
        $this->assertArrayHasKey('id', $createdjenisbarang);
        $this->assertNotNull($createdjenisbarang['id'], 'Created jenisbarang must have id specified');
        $this->assertNotNull(jenisbarang::find($createdjenisbarang['id']), 'jenisbarang with given id must be in DB');
        $this->assertModelData($jenisbarang, $createdjenisbarang);
    }

    /**
     * @test read
     */
    public function test_read_jenisbarang()
    {
        $jenisbarang = factory(jenisbarang::class)->create();

        $dbjenisbarang = $this->jenisbarangRepo->find($jenisbarang->id);

        $dbjenisbarang = $dbjenisbarang->toArray();
        $this->assertModelData($jenisbarang->toArray(), $dbjenisbarang);
    }

    /**
     * @test update
     */
    public function test_update_jenisbarang()
    {
        $jenisbarang = factory(jenisbarang::class)->create();
        $fakejenisbarang = factory(jenisbarang::class)->make()->toArray();

        $updatedjenisbarang = $this->jenisbarangRepo->update($fakejenisbarang, $jenisbarang->id);

        $this->assertModelData($fakejenisbarang, $updatedjenisbarang->toArray());
        $dbjenisbarang = $this->jenisbarangRepo->find($jenisbarang->id);
        $this->assertModelData($fakejenisbarang, $dbjenisbarang->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_jenisbarang()
    {
        $jenisbarang = factory(jenisbarang::class)->create();

        $resp = $this->jenisbarangRepo->delete($jenisbarang->id);

        $this->assertTrue($resp);
        $this->assertNull(jenisbarang::find($jenisbarang->id), 'jenisbarang should not exist in DB');
    }
}
