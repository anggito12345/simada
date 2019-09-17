<?php namespace Tests\Repositories;

use App\Models\kondisi;
use App\Repositories\kondisiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class kondisiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var kondisiRepository
     */
    protected $kondisiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kondisiRepo = \App::make(kondisiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kondisi()
    {
        $kondisi = factory(kondisi::class)->make()->toArray();

        $createdkondisi = $this->kondisiRepo->create($kondisi);

        $createdkondisi = $createdkondisi->toArray();
        $this->assertArrayHasKey('id', $createdkondisi);
        $this->assertNotNull($createdkondisi['id'], 'Created kondisi must have id specified');
        $this->assertNotNull(kondisi::find($createdkondisi['id']), 'kondisi with given id must be in DB');
        $this->assertModelData($kondisi, $createdkondisi);
    }

    /**
     * @test read
     */
    public function test_read_kondisi()
    {
        $kondisi = factory(kondisi::class)->create();

        $dbkondisi = $this->kondisiRepo->find($kondisi->id);

        $dbkondisi = $dbkondisi->toArray();
        $this->assertModelData($kondisi->toArray(), $dbkondisi);
    }

    /**
     * @test update
     */
    public function test_update_kondisi()
    {
        $kondisi = factory(kondisi::class)->create();
        $fakekondisi = factory(kondisi::class)->make()->toArray();

        $updatedkondisi = $this->kondisiRepo->update($fakekondisi, $kondisi->id);

        $this->assertModelData($fakekondisi, $updatedkondisi->toArray());
        $dbkondisi = $this->kondisiRepo->find($kondisi->id);
        $this->assertModelData($fakekondisi, $dbkondisi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kondisi()
    {
        $kondisi = factory(kondisi::class)->create();

        $resp = $this->kondisiRepo->delete($kondisi->id);

        $this->assertTrue($resp);
        $this->assertNull(kondisi::find($kondisi->id), 'kondisi should not exist in DB');
    }
}
