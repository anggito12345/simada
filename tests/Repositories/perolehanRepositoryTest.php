<?php namespace Tests\Repositories;

use App\Models\perolehan;
use App\Repositories\perolehanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class perolehanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var perolehanRepository
     */
    protected $perolehanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->perolehanRepo = \App::make(perolehanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_perolehan()
    {
        $perolehan = factory(perolehan::class)->make()->toArray();

        $createdperolehan = $this->perolehanRepo->create($perolehan);

        $createdperolehan = $createdperolehan->toArray();
        $this->assertArrayHasKey('id', $createdperolehan);
        $this->assertNotNull($createdperolehan['id'], 'Created perolehan must have id specified');
        $this->assertNotNull(perolehan::find($createdperolehan['id']), 'perolehan with given id must be in DB');
        $this->assertModelData($perolehan, $createdperolehan);
    }

    /**
     * @test read
     */
    public function test_read_perolehan()
    {
        $perolehan = factory(perolehan::class)->create();

        $dbperolehan = $this->perolehanRepo->find($perolehan->id);

        $dbperolehan = $dbperolehan->toArray();
        $this->assertModelData($perolehan->toArray(), $dbperolehan);
    }

    /**
     * @test update
     */
    public function test_update_perolehan()
    {
        $perolehan = factory(perolehan::class)->create();
        $fakeperolehan = factory(perolehan::class)->make()->toArray();

        $updatedperolehan = $this->perolehanRepo->update($fakeperolehan, $perolehan->id);

        $this->assertModelData($fakeperolehan, $updatedperolehan->toArray());
        $dbperolehan = $this->perolehanRepo->find($perolehan->id);
        $this->assertModelData($fakeperolehan, $dbperolehan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_perolehan()
    {
        $perolehan = factory(perolehan::class)->create();

        $resp = $this->perolehanRepo->delete($perolehan->id);

        $this->assertTrue($resp);
        $this->assertNull(perolehan::find($perolehan->id), 'perolehan should not exist in DB');
    }
}
