<?php namespace Tests\Repositories;

use App\Models\m_kode_daerah;
use App\Repositories\m_kode_daerahRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class m_kode_daerahRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var m_kode_daerahRepository
     */
    protected $mKodeDaerahRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mKodeDaerahRepo = \App::make(m_kode_daerahRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_m_kode_daerah()
    {
        $mKodeDaerah = factory(m_kode_daerah::class)->make()->toArray();

        $createdm_kode_daerah = $this->mKodeDaerahRepo->create($mKodeDaerah);

        $createdm_kode_daerah = $createdm_kode_daerah->toArray();
        $this->assertArrayHasKey('id', $createdm_kode_daerah);
        $this->assertNotNull($createdm_kode_daerah['id'], 'Created m_kode_daerah must have id specified');
        $this->assertNotNull(m_kode_daerah::find($createdm_kode_daerah['id']), 'm_kode_daerah with given id must be in DB');
        $this->assertModelData($mKodeDaerah, $createdm_kode_daerah);
    }

    /**
     * @test read
     */
    public function test_read_m_kode_daerah()
    {
        $mKodeDaerah = factory(m_kode_daerah::class)->create();

        $dbm_kode_daerah = $this->mKodeDaerahRepo->find($mKodeDaerah->id);

        $dbm_kode_daerah = $dbm_kode_daerah->toArray();
        $this->assertModelData($mKodeDaerah->toArray(), $dbm_kode_daerah);
    }

    /**
     * @test update
     */
    public function test_update_m_kode_daerah()
    {
        $mKodeDaerah = factory(m_kode_daerah::class)->create();
        $fakem_kode_daerah = factory(m_kode_daerah::class)->make()->toArray();

        $updatedm_kode_daerah = $this->mKodeDaerahRepo->update($fakem_kode_daerah, $mKodeDaerah->id);

        $this->assertModelData($fakem_kode_daerah, $updatedm_kode_daerah->toArray());
        $dbm_kode_daerah = $this->mKodeDaerahRepo->find($mKodeDaerah->id);
        $this->assertModelData($fakem_kode_daerah, $dbm_kode_daerah->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_m_kode_daerah()
    {
        $mKodeDaerah = factory(m_kode_daerah::class)->create();

        $resp = $this->mKodeDaerahRepo->delete($mKodeDaerah->id);

        $this->assertTrue($resp);
        $this->assertNull(m_kode_daerah::find($mKodeDaerah->id), 'm_kode_daerah should not exist in DB');
    }
}
