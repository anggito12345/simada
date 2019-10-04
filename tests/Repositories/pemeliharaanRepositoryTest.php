<?php namespace Tests\Repositories;

use App\Models\pemeliharaan;
use App\Repositories\pemeliharaanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class pemeliharaanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var pemeliharaanRepository
     */
    protected $pemeliharaanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pemeliharaanRepo = \App::make(pemeliharaanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_pemeliharaan()
    {
        $pemeliharaan = factory(pemeliharaan::class)->make()->toArray();

        $createdpemeliharaan = $this->pemeliharaanRepo->create($pemeliharaan);

        $createdpemeliharaan = $createdpemeliharaan->toArray();
        $this->assertArrayHasKey('id', $createdpemeliharaan);
        $this->assertNotNull($createdpemeliharaan['id'], 'Created pemeliharaan must have id specified');
        $this->assertNotNull(pemeliharaan::find($createdpemeliharaan['id']), 'pemeliharaan with given id must be in DB');
        $this->assertModelData($pemeliharaan, $createdpemeliharaan);
    }

    /**
     * @test read
     */
    public function test_read_pemeliharaan()
    {
        $pemeliharaan = factory(pemeliharaan::class)->create();

        $dbpemeliharaan = $this->pemeliharaanRepo->find($pemeliharaan->id);

        $dbpemeliharaan = $dbpemeliharaan->toArray();
        $this->assertModelData($pemeliharaan->toArray(), $dbpemeliharaan);
    }

    /**
     * @test update
     */
    public function test_update_pemeliharaan()
    {
        $pemeliharaan = factory(pemeliharaan::class)->create();
        $fakepemeliharaan = factory(pemeliharaan::class)->make()->toArray();

        $updatedpemeliharaan = $this->pemeliharaanRepo->update($fakepemeliharaan, $pemeliharaan->id);

        $this->assertModelData($fakepemeliharaan, $updatedpemeliharaan->toArray());
        $dbpemeliharaan = $this->pemeliharaanRepo->find($pemeliharaan->id);
        $this->assertModelData($fakepemeliharaan, $dbpemeliharaan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_pemeliharaan()
    {
        $pemeliharaan = factory(pemeliharaan::class)->create();

        $resp = $this->pemeliharaanRepo->delete($pemeliharaan->id);

        $this->assertTrue($resp);
        $this->assertNull(pemeliharaan::find($pemeliharaan->id), 'pemeliharaan should not exist in DB');
    }
}
