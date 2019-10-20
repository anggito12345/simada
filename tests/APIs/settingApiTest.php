<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\setting;

class settingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_setting()
    {
        $setting = factory(setting::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/settings', $setting
        );

        $this->assertApiResponse($setting);
    }

    /**
     * @test
     */
    public function test_read_setting()
    {
        $setting = factory(setting::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/settings/'.$setting->id
        );

        $this->assertApiResponse($setting->toArray());
    }

    /**
     * @test
     */
    public function test_update_setting()
    {
        $setting = factory(setting::class)->create();
        $editedsetting = factory(setting::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/settings/'.$setting->id,
            $editedsetting
        );

        $this->assertApiResponse($editedsetting);
    }

    /**
     * @test
     */
    public function test_delete_setting()
    {
        $setting = factory(setting::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/settings/'.$setting->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/settings/'.$setting->id
        );

        $this->response->assertStatus(404);
    }
}
