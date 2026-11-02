<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\MasterItem;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MasterItemCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(User::factory()->create(['role' => UserRole::Owner]));
    }

    public function test_owner_can_list_master_items_paginated(): void
    {
        MasterItem::factory()->count(3)->create();

        $this->getJson('/api/owner/master-items')
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure(['data' => [['id', 'name', 'rooms_count']], 'meta']);
    }

    public function test_owner_can_list_all_master_items_without_pagination(): void
    {
        MasterItem::factory()->count(20)->create();

        $this->getJson('/api/owner/master-items?all=1')
            ->assertOk()
            ->assertJsonCount(20, 'data')
            ->assertJsonMissingPath('meta');
    }

    public function test_owner_can_search_master_items(): void
    {
        MasterItem::factory()->create(['name' => 'Lampu']);
        MasterItem::factory()->create(['name' => 'Kasur']);

        $this->getJson('/api/owner/master-items?search=lam')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Lampu');
    }

    public function test_owner_can_create_master_item(): void
    {
        $this->postJson('/api/owner/master-items', ['name' => 'Rak Sepatu', 'description' => 'Rak di depan pintu'])
            ->assertCreated()
            ->assertJsonPath('data.name', 'Rak Sepatu');

        $this->assertDatabaseHas('master_items', ['name' => 'Rak Sepatu']);
    }

    public function test_master_item_name_must_be_unique(): void
    {
        MasterItem::factory()->create(['name' => 'Kasur']);

        $this->postJson('/api/owner/master-items', ['name' => 'Kasur'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('name');
    }

    public function test_owner_can_update_master_item_keeping_same_name(): void
    {
        $item = MasterItem::factory()->create(['name' => 'Kasur']);

        $this->putJson("/api/owner/master-items/{$item->id}", ['name' => 'Kasur', 'description' => 'Kasur busa'])
            ->assertOk()
            ->assertJsonPath('data.description', 'Kasur busa');
    }

    public function test_owner_can_delete_master_item(): void
    {
        $item = MasterItem::factory()->create();

        $this->deleteJson("/api/owner/master-items/{$item->id}")->assertOk();

        $this->assertSoftDeleted($item);
    }

    public function test_deleted_master_item_disappears_from_room_items(): void
    {
        $room = Room::factory()->create();
        $keep = MasterItem::factory()->create();
        $remove = MasterItem::factory()->create();
        $room->masterItems()->attach([$keep->id, $remove->id]);

        $this->deleteJson("/api/owner/master-items/{$remove->id}")->assertOk();

        $this->getJson("/api/owner/rooms/{$room->id}")
            ->assertOk()
            ->assertJsonCount(1, 'data.master_items')
            ->assertJsonPath('data.master_items.0.id', $keep->id);
    }

    public function test_tenant_cannot_manage_master_items(): void
    {
        Sanctum::actingAs(User::factory()->create(['role' => UserRole::Tenant]));

        $this->getJson('/api/owner/master-items')->assertForbidden();
    }
}
