<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\alamat;

class alamatApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_alamat()
    {
        $alamat = factory(alamat::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/alamats', $alamat
        );

        $this->assertApiResponse($alamat);
    }

    /**
     * @test
     */
    public function test_read_alamat()
    {
        $alamat = factory(alamat::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/alamats/'.$alamat->id
        );

        $this->assertApiResponse($alamat->toArray());
    }

    /**
     * @test
     */
    public function test_update_alamat()
    {
        $alamat = factory(alamat::class)->create();
        $editedalamat = factory(alamat::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/alamats/'.$alamat->id,
            $editedalamat
        );

        $this->assertApiResponse($editedalamat);
    }

    /**
     * @test
     */
    public function test_delete_alamat()
    {
        $alamat = factory(alamat::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/alamats/'.$alamat->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/alamats/'.$alamat->id
        );

        $this->response->assertStatus(404);
    }
}
