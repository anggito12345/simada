<?php namespace Tests\Repositories;

use App\Models\rka;
use App\Repositories\rkaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class rkaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var rkaRepository
     */
    protected $rkaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rkaRepo = \App::make(rkaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rka()
    {
        $rka = factory(rka::class)->make()->toArray();

        $createdrka = $this->rkaRepo->create($rka);

        $createdrka = $createdrka->toArray();
        $this->assertArrayHasKey('id', $createdrka);
        $this->assertNotNull($createdrka['id'], 'Created rka must have id specified');
        $this->assertNotNull(rka::find($createdrka['id']), 'rka with given id must be in DB');
        $this->assertModelData($rka, $createdrka);
    }

    /**
     * @test read
     */
    public function test_read_rka()
    {
        $rka = factory(rka::class)->create();

        $dbrka = $this->rkaRepo->find($rka->id);

        $dbrka = $dbrka->toArray();
        $this->assertModelData($rka->toArray(), $dbrka);
    }

    /**
     * @test update
     */
    public function test_update_rka()
    {
        $rka = factory(rka::class)->create();
        $fakerka = factory(rka::class)->make()->toArray();

        $updatedrka = $this->rkaRepo->update($fakerka, $rka->id);

        $this->assertModelData($fakerka, $updatedrka->toArray());
        $dbrka = $this->rkaRepo->find($rka->id);
        $this->assertModelData($fakerka, $dbrka->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rka()
    {
        $rka = factory(rka::class)->create();

        $resp = $this->rkaRepo->delete($rka->id);

        $this->assertTrue($resp);
        $this->assertNull(rka::find($rka->id), 'rka should not exist in DB');
    }
}
