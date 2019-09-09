<?php namespace Tests\Repositories;

use App\Models\statustanah;
use App\Repositories\statustanahRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class statustanahRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var statustanahRepository
     */
    protected $statustanahRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->statustanahRepo = \App::make(statustanahRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_statustanah()
    {
        $statustanah = factory(statustanah::class)->make()->toArray();

        $createdstatustanah = $this->statustanahRepo->create($statustanah);

        $createdstatustanah = $createdstatustanah->toArray();
        $this->assertArrayHasKey('id', $createdstatustanah);
        $this->assertNotNull($createdstatustanah['id'], 'Created statustanah must have id specified');
        $this->assertNotNull(statustanah::find($createdstatustanah['id']), 'statustanah with given id must be in DB');
        $this->assertModelData($statustanah, $createdstatustanah);
    }

    /**
     * @test read
     */
    public function test_read_statustanah()
    {
        $statustanah = factory(statustanah::class)->create();

        $dbstatustanah = $this->statustanahRepo->find($statustanah->id);

        $dbstatustanah = $dbstatustanah->toArray();
        $this->assertModelData($statustanah->toArray(), $dbstatustanah);
    }

    /**
     * @test update
     */
    public function test_update_statustanah()
    {
        $statustanah = factory(statustanah::class)->create();
        $fakestatustanah = factory(statustanah::class)->make()->toArray();

        $updatedstatustanah = $this->statustanahRepo->update($fakestatustanah, $statustanah->id);

        $this->assertModelData($fakestatustanah, $updatedstatustanah->toArray());
        $dbstatustanah = $this->statustanahRepo->find($statustanah->id);
        $this->assertModelData($fakestatustanah, $dbstatustanah->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_statustanah()
    {
        $statustanah = factory(statustanah::class)->create();

        $resp = $this->statustanahRepo->delete($statustanah->id);

        $this->assertTrue($resp);
        $this->assertNull(statustanah::find($statustanah->id), 'statustanah should not exist in DB');
    }
}
