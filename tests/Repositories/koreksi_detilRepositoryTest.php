<?php namespace Tests\Repositories;

use App\Models\koreksi_detil;
use App\Repositories\koreksi_detilRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class koreksi_detilRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var koreksi_detilRepository
     */
    protected $koreksiDetilRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->koreksiDetilRepo = \App::make(koreksi_detilRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_koreksi_detil()
    {
        $koreksiDetil = factory(koreksi_detil::class)->make()->toArray();

        $createdkoreksi_detil = $this->koreksiDetilRepo->create($koreksiDetil);

        $createdkoreksi_detil = $createdkoreksi_detil->toArray();
        $this->assertArrayHasKey('id', $createdkoreksi_detil);
        $this->assertNotNull($createdkoreksi_detil['id'], 'Created koreksi_detil must have id specified');
        $this->assertNotNull(koreksi_detil::find($createdkoreksi_detil['id']), 'koreksi_detil with given id must be in DB');
        $this->assertModelData($koreksiDetil, $createdkoreksi_detil);
    }

    /**
     * @test read
     */
    public function test_read_koreksi_detil()
    {
        $koreksiDetil = factory(koreksi_detil::class)->create();

        $dbkoreksi_detil = $this->koreksiDetilRepo->find($koreksiDetil->id);

        $dbkoreksi_detil = $dbkoreksi_detil->toArray();
        $this->assertModelData($koreksiDetil->toArray(), $dbkoreksi_detil);
    }

    /**
     * @test update
     */
    public function test_update_koreksi_detil()
    {
        $koreksiDetil = factory(koreksi_detil::class)->create();
        $fakekoreksi_detil = factory(koreksi_detil::class)->make()->toArray();

        $updatedkoreksi_detil = $this->koreksiDetilRepo->update($fakekoreksi_detil, $koreksiDetil->id);

        $this->assertModelData($fakekoreksi_detil, $updatedkoreksi_detil->toArray());
        $dbkoreksi_detil = $this->koreksiDetilRepo->find($koreksiDetil->id);
        $this->assertModelData($fakekoreksi_detil, $dbkoreksi_detil->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_koreksi_detil()
    {
        $koreksiDetil = factory(koreksi_detil::class)->create();

        $resp = $this->koreksiDetilRepo->delete($koreksiDetil->id);

        $this->assertTrue($resp);
        $this->assertNull(koreksi_detil::find($koreksiDetil->id), 'koreksi_detil should not exist in DB');
    }
}
