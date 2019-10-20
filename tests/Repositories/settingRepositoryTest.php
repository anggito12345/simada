<?php namespace Tests\Repositories;

use App\Models\setting;
use App\Repositories\settingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class settingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var settingRepository
     */
    protected $settingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->settingRepo = \App::make(settingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_setting()
    {
        $setting = factory(setting::class)->make()->toArray();

        $createdsetting = $this->settingRepo->create($setting);

        $createdsetting = $createdsetting->toArray();
        $this->assertArrayHasKey('id', $createdsetting);
        $this->assertNotNull($createdsetting['id'], 'Created setting must have id specified');
        $this->assertNotNull(setting::find($createdsetting['id']), 'setting with given id must be in DB');
        $this->assertModelData($setting, $createdsetting);
    }

    /**
     * @test read
     */
    public function test_read_setting()
    {
        $setting = factory(setting::class)->create();

        $dbsetting = $this->settingRepo->find($setting->id);

        $dbsetting = $dbsetting->toArray();
        $this->assertModelData($setting->toArray(), $dbsetting);
    }

    /**
     * @test update
     */
    public function test_update_setting()
    {
        $setting = factory(setting::class)->create();
        $fakesetting = factory(setting::class)->make()->toArray();

        $updatedsetting = $this->settingRepo->update($fakesetting, $setting->id);

        $this->assertModelData($fakesetting, $updatedsetting->toArray());
        $dbsetting = $this->settingRepo->find($setting->id);
        $this->assertModelData($fakesetting, $dbsetting->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_setting()
    {
        $setting = factory(setting::class)->create();

        $resp = $this->settingRepo->delete($setting->id);

        $this->assertTrue($resp);
        $this->assertNull(setting::find($setting->id), 'setting should not exist in DB');
    }
}
