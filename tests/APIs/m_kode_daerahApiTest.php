<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\m_kode_daerah;

class m_kode_daerahApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_m_kode_daerah()
    {
        $mKodeDaerah = factory(m_kode_daerah::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/m_kode_daerahs', $mKodeDaerah
        );

        $this->assertApiResponse($mKodeDaerah);
    }

    /**
     * @test
     */
    public function test_read_m_kode_daerah()
    {
        $mKodeDaerah = factory(m_kode_daerah::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/m_kode_daerahs/'.$mKodeDaerah->id
        );

        $this->assertApiResponse($mKodeDaerah->toArray());
    }

    /**
     * @test
     */
    public function test_update_m_kode_daerah()
    {
        $mKodeDaerah = factory(m_kode_daerah::class)->create();
        $editedm_kode_daerah = factory(m_kode_daerah::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/m_kode_daerahs/'.$mKodeDaerah->id,
            $editedm_kode_daerah
        );

        $this->assertApiResponse($editedm_kode_daerah);
    }

    /**
     * @test
     */
    public function test_delete_m_kode_daerah()
    {
        $mKodeDaerah = factory(m_kode_daerah::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/m_kode_daerahs/'.$mKodeDaerah->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/m_kode_daerahs/'.$mKodeDaerah->id
        );

        $this->response->assertStatus(404);
    }
}
