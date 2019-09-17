<?php namespace Tests\Repositories;

use App\Models\jenisopd;
use App\Repositories\jenisopdRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class jenisopdRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var jenisopdRepository
     */
    protected $jenisopdRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->jenisopdRepo = \App::make(jenisopdRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_jenisopd()
    {
        $jenisopd = factory(jenisopd::class)->make()->toArray();

        $createdjenisopd = $this->jenisopdRepo->create($jenisopd);

        $createdjenisopd = $createdjenisopd->toArray();
        $this->assertArrayHasKey('id', $createdjenisopd);
        $this->assertNotNull($createdjenisopd['id'], 'Created jenisopd must have id specified');
        $this->assertNotNull(jenisopd::find($createdjenisopd['id']), 'jenisopd with given id must be in DB');
        $this->assertModelData($jenisopd, $createdjenisopd);
    }

    /**
     * @test read
     */
    public function test_read_jenisopd()
    {
        $jenisopd = factory(jenisopd::class)->create();

        $dbjenisopd = $this->jenisopdRepo->find($jenisopd->id);

        $dbjenisopd = $dbjenisopd->toArray();
        $this->assertModelData($jenisopd->toArray(), $dbjenisopd);
    }

    /**
     * @test update
     */
    public function test_update_jenisopd()
    {
        $jenisopd = factory(jenisopd::class)->create();
        $fakejenisopd = factory(jenisopd::class)->make()->toArray();

        $updatedjenisopd = $this->jenisopdRepo->update($fakejenisopd, $jenisopd->id);

        $this->assertModelData($fakejenisopd, $updatedjenisopd->toArray());
        $dbjenisopd = $this->jenisopdRepo->find($jenisopd->id);
        $this->assertModelData($fakejenisopd, $dbjenisopd->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_jenisopd()
    {
        $jenisopd = factory(jenisopd::class)->create();

        $resp = $this->jenisopdRepo->delete($jenisopd->id);

        $this->assertTrue($resp);
        $this->assertNull(jenisopd::find($jenisopd->id), 'jenisopd should not exist in DB');
    }
}
