<?php namespace Tests\Repositories;

use App\Models\jabatan;
use App\Repositories\jabatanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class jabatanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var jabatanRepository
     */
    protected $jabatanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->jabatanRepo = \App::make(jabatanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_jabatan()
    {
        $jabatan = factory(jabatan::class)->make()->toArray();

        $createdjabatan = $this->jabatanRepo->create($jabatan);

        $createdjabatan = $createdjabatan->toArray();
        $this->assertArrayHasKey('id', $createdjabatan);
        $this->assertNotNull($createdjabatan['id'], 'Created jabatan must have id specified');
        $this->assertNotNull(jabatan::find($createdjabatan['id']), 'jabatan with given id must be in DB');
        $this->assertModelData($jabatan, $createdjabatan);
    }

    /**
     * @test read
     */
    public function test_read_jabatan()
    {
        $jabatan = factory(jabatan::class)->create();

        $dbjabatan = $this->jabatanRepo->find($jabatan->id);

        $dbjabatan = $dbjabatan->toArray();
        $this->assertModelData($jabatan->toArray(), $dbjabatan);
    }

    /**
     * @test update
     */
    public function test_update_jabatan()
    {
        $jabatan = factory(jabatan::class)->create();
        $fakejabatan = factory(jabatan::class)->make()->toArray();

        $updatedjabatan = $this->jabatanRepo->update($fakejabatan, $jabatan->id);

        $this->assertModelData($fakejabatan, $updatedjabatan->toArray());
        $dbjabatan = $this->jabatanRepo->find($jabatan->id);
        $this->assertModelData($fakejabatan, $dbjabatan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_jabatan()
    {
        $jabatan = factory(jabatan::class)->create();

        $resp = $this->jabatanRepo->delete($jabatan->id);

        $this->assertTrue($resp);
        $this->assertNull(jabatan::find($jabatan->id), 'jabatan should not exist in DB');
    }
}
