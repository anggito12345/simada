<?php namespace Tests\Repositories;

use App\Models\inventaris_history;
use App\Repositories\inventaris_historyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class inventaris_historyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var inventaris_historyRepository
     */
    protected $inventarisHistoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->inventarisHistoryRepo = \App::make(inventaris_historyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_inventaris_history()
    {
        $inventarisHistory = factory(inventaris_history::class)->make()->toArray();

        $createdinventaris_history = $this->inventarisHistoryRepo->create($inventarisHistory);

        $createdinventaris_history = $createdinventaris_history->toArray();
        $this->assertArrayHasKey('id', $createdinventaris_history);
        $this->assertNotNull($createdinventaris_history['id'], 'Created inventaris_history must have id specified');
        $this->assertNotNull(inventaris_history::find($createdinventaris_history['id']), 'inventaris_history with given id must be in DB');
        $this->assertModelData($inventarisHistory, $createdinventaris_history);
    }

    /**
     * @test read
     */
    public function test_read_inventaris_history()
    {
        $inventarisHistory = factory(inventaris_history::class)->create();

        $dbinventaris_history = $this->inventarisHistoryRepo->find($inventarisHistory->id);

        $dbinventaris_history = $dbinventaris_history->toArray();
        $this->assertModelData($inventarisHistory->toArray(), $dbinventaris_history);
    }

    /**
     * @test update
     */
    public function test_update_inventaris_history()
    {
        $inventarisHistory = factory(inventaris_history::class)->create();
        $fakeinventaris_history = factory(inventaris_history::class)->make()->toArray();

        $updatedinventaris_history = $this->inventarisHistoryRepo->update($fakeinventaris_history, $inventarisHistory->id);

        $this->assertModelData($fakeinventaris_history, $updatedinventaris_history->toArray());
        $dbinventaris_history = $this->inventarisHistoryRepo->find($inventarisHistory->id);
        $this->assertModelData($fakeinventaris_history, $dbinventaris_history->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_inventaris_history()
    {
        $inventarisHistory = factory(inventaris_history::class)->create();

        $resp = $this->inventarisHistoryRepo->delete($inventarisHistory->id);

        $this->assertTrue($resp);
        $this->assertNull(inventaris_history::find($inventarisHistory->id), 'inventaris_history should not exist in DB');
    }
}
