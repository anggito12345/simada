<?php namespace Tests\Repositories;

use App\Models\system_upload;
use App\Repositories\system_uploadRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class system_uploadRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var system_uploadRepository
     */
    protected $systemUploadRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->systemUploadRepo = \App::make(system_uploadRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_system_upload()
    {
        $systemUpload = factory(system_upload::class)->make()->toArray();

        $createdsystem_upload = $this->systemUploadRepo->create($systemUpload);

        $createdsystem_upload = $createdsystem_upload->toArray();
        $this->assertArrayHasKey('id', $createdsystem_upload);
        $this->assertNotNull($createdsystem_upload['id'], 'Created system_upload must have id specified');
        $this->assertNotNull(system_upload::find($createdsystem_upload['id']), 'system_upload with given id must be in DB');
        $this->assertModelData($systemUpload, $createdsystem_upload);
    }

    /**
     * @test read
     */
    public function test_read_system_upload()
    {
        $systemUpload = factory(system_upload::class)->create();

        $dbsystem_upload = $this->systemUploadRepo->find($systemUpload->id);

        $dbsystem_upload = $dbsystem_upload->toArray();
        $this->assertModelData($systemUpload->toArray(), $dbsystem_upload);
    }

    /**
     * @test update
     */
    public function test_update_system_upload()
    {
        $systemUpload = factory(system_upload::class)->create();
        $fakesystem_upload = factory(system_upload::class)->make()->toArray();

        $updatedsystem_upload = $this->systemUploadRepo->update($fakesystem_upload, $systemUpload->id);

        $this->assertModelData($fakesystem_upload, $updatedsystem_upload->toArray());
        $dbsystem_upload = $this->systemUploadRepo->find($systemUpload->id);
        $this->assertModelData($fakesystem_upload, $dbsystem_upload->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_system_upload()
    {
        $systemUpload = factory(system_upload::class)->create();

        $resp = $this->systemUploadRepo->delete($systemUpload->id);

        $this->assertTrue($resp);
        $this->assertNull(system_upload::find($systemUpload->id), 'system_upload should not exist in DB');
    }
}
