<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\detilaset;

class detilasetApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_detilaset()
    {
        $detilaset = factory(detilaset::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/detilasets', $detilaset
        );

        $this->assertApiResponse($detilaset);
    }

    /**
     * @test
     */
    public function test_read_detilaset()
    {
        $detilaset = factory(detilaset::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/detilasets/'.$detilaset->id
        );

        $this->assertApiResponse($detilaset->toArray());
    }

    /**
     * @test
     */
    public function test_update_detilaset()
    {
        $detilaset = factory(detilaset::class)->create();
        $editeddetilaset = factory(detilaset::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/detilasets/'.$detilaset->id,
            $editeddetilaset
        );

        $this->assertApiResponse($editeddetilaset);
    }

    /**
     * @test
     */
    public function test_delete_detilaset()
    {
        $detilaset = factory(detilaset::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/detilasets/'.$detilaset->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/detilasets/'.$detilaset->id
        );

        $this->response->assertStatus(404);
    }
}
