<?php namespace Tests\Repositories;

use App\Models\pemanfaatan;
use App\Repositories\pemanfaatanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class pemanfaatanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var pemanfaatanRepository
     */
    protected $pemanfaatanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pemanfaatanRepo = \App::make(pemanfaatanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_pemanfaatan()
    {
        $pemanfaatan = factory(pemanfaatan::class)->make()->toArray();

        $createdpemanfaatan = $this->pemanfaatanRepo->create($pemanfaatan);

        $createdpemanfaatan = $createdpemanfaatan->toArray();
        $this->assertArrayHasKey('id', $createdpemanfaatan);
        $this->assertNotNull($createdpemanfaatan['id'], 'Created pemanfaatan must have id specified');
        $this->assertNotNull(pemanfaatan::find($createdpemanfaatan['id']), 'pemanfaatan with given id must be in DB');
        $this->assertModelData($pemanfaatan, $createdpemanfaatan);
    }

    /**
     * @test read
     */
    public function test_read_pemanfaatan()
    {
        $pemanfaatan = factory(pemanfaatan::class)->create();

        $dbpemanfaatan = $this->pemanfaatanRepo->find($pemanfaatan->id);

        $dbpemanfaatan = $dbpemanfaatan->toArray();
        $this->assertModelData($pemanfaatan->toArray(), $dbpemanfaatan);
    }

    /**
     * @test update
     */
    public function test_update_pemanfaatan()
    {
        $pemanfaatan = factory(pemanfaatan::class)->create();
        $fakepemanfaatan = factory(pemanfaatan::class)->make()->toArray();

        $updatedpemanfaatan = $this->pemanfaatanRepo->update($fakepemanfaatan, $pemanfaatan->id);

        $this->assertModelData($fakepemanfaatan, $updatedpemanfaatan->toArray());
        $dbpemanfaatan = $this->pemanfaatanRepo->find($pemanfaatan->id);
        $this->assertModelData($fakepemanfaatan, $dbpemanfaatan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_pemanfaatan()
    {
        $pemanfaatan = factory(pemanfaatan::class)->create();

        $resp = $this->pemanfaatanRepo->delete($pemanfaatan->id);

        $this->assertTrue($resp);
        $this->assertNull(pemanfaatan::find($pemanfaatan->id), 'pemanfaatan should not exist in DB');
    }
}
