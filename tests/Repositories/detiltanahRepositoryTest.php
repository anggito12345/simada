<?php namespace Tests\Repositories;

use App\Models\detiltanah;
use App\Repositories\detiltanahRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class detiltanahRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var detiltanahRepository
     */
    protected $detiltanahRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->detiltanahRepo = \App::make(detiltanahRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_detiltanah()
    {
        $detiltanah = factory(detiltanah::class)->make()->toArray();

        $createddetiltanah = $this->detiltanahRepo->create($detiltanah);

        $createddetiltanah = $createddetiltanah->toArray();
        $this->assertArrayHasKey('id', $createddetiltanah);
        $this->assertNotNull($createddetiltanah['id'], 'Created detiltanah must have id specified');
        $this->assertNotNull(detiltanah::find($createddetiltanah['id']), 'detiltanah with given id must be in DB');
        $this->assertModelData($detiltanah, $createddetiltanah);
    }

    /**
     * @test read
     */
    public function test_read_detiltanah()
    {
        $detiltanah = factory(detiltanah::class)->create();

        $dbdetiltanah = $this->detiltanahRepo->find($detiltanah->id);

        $dbdetiltanah = $dbdetiltanah->toArray();
        $this->assertModelData($detiltanah->toArray(), $dbdetiltanah);
    }

    /**
     * @test update
     */
    public function test_update_detiltanah()
    {
        $detiltanah = factory(detiltanah::class)->create();
        $fakedetiltanah = factory(detiltanah::class)->make()->toArray();

        $updateddetiltanah = $this->detiltanahRepo->update($fakedetiltanah, $detiltanah->id);

        $this->assertModelData($fakedetiltanah, $updateddetiltanah->toArray());
        $dbdetiltanah = $this->detiltanahRepo->find($detiltanah->id);
        $this->assertModelData($fakedetiltanah, $dbdetiltanah->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_detiltanah()
    {
        $detiltanah = factory(detiltanah::class)->create();

        $resp = $this->detiltanahRepo->delete($detiltanah->id);

        $this->assertTrue($resp);
        $this->assertNull(detiltanah::find($detiltanah->id), 'detiltanah should not exist in DB');
    }
}
