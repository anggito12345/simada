<?php namespace Tests\Repositories;

use App\Models\merkbarang;
use App\Repositories\merkbarangRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class merkbarangRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var merkbarangRepository
     */
    protected $merkbarangRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->merkbarangRepo = \App::make(merkbarangRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_merkbarang()
    {
        $merkbarang = factory(merkbarang::class)->make()->toArray();

        $createdmerkbarang = $this->merkbarangRepo->create($merkbarang);

        $createdmerkbarang = $createdmerkbarang->toArray();
        $this->assertArrayHasKey('id', $createdmerkbarang);
        $this->assertNotNull($createdmerkbarang['id'], 'Created merkbarang must have id specified');
        $this->assertNotNull(merkbarang::find($createdmerkbarang['id']), 'merkbarang with given id must be in DB');
        $this->assertModelData($merkbarang, $createdmerkbarang);
    }

    /**
     * @test read
     */
    public function test_read_merkbarang()
    {
        $merkbarang = factory(merkbarang::class)->create();

        $dbmerkbarang = $this->merkbarangRepo->find($merkbarang->id);

        $dbmerkbarang = $dbmerkbarang->toArray();
        $this->assertModelData($merkbarang->toArray(), $dbmerkbarang);
    }

    /**
     * @test update
     */
    public function test_update_merkbarang()
    {
        $merkbarang = factory(merkbarang::class)->create();
        $fakemerkbarang = factory(merkbarang::class)->make()->toArray();

        $updatedmerkbarang = $this->merkbarangRepo->update($fakemerkbarang, $merkbarang->id);

        $this->assertModelData($fakemerkbarang, $updatedmerkbarang->toArray());
        $dbmerkbarang = $this->merkbarangRepo->find($merkbarang->id);
        $this->assertModelData($fakemerkbarang, $dbmerkbarang->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_merkbarang()
    {
        $merkbarang = factory(merkbarang::class)->create();

        $resp = $this->merkbarangRepo->delete($merkbarang->id);

        $this->assertTrue($resp);
        $this->assertNull(merkbarang::find($merkbarang->id), 'merkbarang should not exist in DB');
    }
}
