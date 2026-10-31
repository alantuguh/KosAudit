<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\MasterItem;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RoomCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(User::factory()->create(['role' => UserRole::Owner]));
    }

    public function test_owner_can_list_rooms_with_pagination(): void
    {
        Room::factory()->count(3)->create();

        $this->getJson('/api/owner/rooms')
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure(['data' => [['id', 'room_number', 'status', 'master_items_count']], 'meta', 'links']);
    }

    public function test_owner_can_filter_rooms_by_status(): void
    {
        Room::factory()->count(2)->create();
        Room::factory()->needsRepair()->create();

        $this->getJson('/api/owner/rooms?status=butuh_perbaikan')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.status', 'butuh_perbaikan');
    }

    public function test_owner_can_create_room_with_items(): void
    {
        $kasur = MasterItem::factory()->create(['name' => 'Kasur']);
        $lampu = MasterItem::factory()->create(['name' => 'Lampu']);

        $this->postJson('/api/owner/rooms', [
            'room_number' => '301',
            'type' => 'AC',
            'monthly_price' => 1_200_000,
            'items' => [
                ['master_item_id' => $kasur->id],
                ['master_item_id' => $lampu->id, 'quantity' => 2],
            ],
        ])
            ->assertCreated()
            ->assertJsonPath('data.status', 'kosong')
            ->assertJsonCount(2, 'data.master_items');

        $room = Room::where('room_number', '301')->firstOrFail();

        $this->assertDatabaseHas('room_master_item', ['room_id' => $room->id, 'master_item_id' => $kasur->id, 'quantity' => 1]);
        $this->assertDatabaseHas('room_master_item', ['room_id' => $room->id, 'master_item_id' => $lampu->id, 'quantity' => 2]);
    }

    public function test_room_number_must_be_unique(): void
    {
        Room::factory()->create(['room_number' => '101']);

        $this->postJson('/api/owner/rooms', [
            'room_number' => '101',
            'type' => 'Standar',
            'monthly_price' => 800_000,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('room_number');
    }

    public function test_owner_cannot_set_status_occupied_manually(): void
    {
        $this->postJson('/api/owner/rooms', [
            'room_number' => '302',
            'type' => 'Standar',
            'monthly_price' => 800_000,
            'status' => 'terisi',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('status');
    }

    public function test_cannot_attach_deleted_master_item(): void
    {
        $item = MasterItem::factory()->create();
        $item->delete();

        $this->postJson('/api/owner/rooms', [
            'room_number' => '303',
            'type' => 'Standar',
            'monthly_price' => 800_000,
            'items' => [['master_item_id' => $item->id]],
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('items.0.master_item_id');
    }

    public function test_owner_can_view_room_detail_with_items(): void
    {
        $room = Room::factory()->create();
        $room->masterItems()->attach(MasterItem::factory()->create(), ['quantity' => 3]);

        $this->getJson("/api/owner/rooms/{$room->id}")
            ->assertOk()
            ->assertJsonPath('data.master_items.0.quantity', 3);
    }

    public function test_owner_can_update_room_and_replace_items(): void
    {
        $room = Room::factory()->create(['monthly_price' => 800_000]);
        $old = MasterItem::factory()->create();
        $new = MasterItem::factory()->create();
        $room->masterItems()->attach($old);

        $this->patchJson("/api/owner/rooms/{$room->id}", [
            'monthly_price' => 900_000,
            'items' => [['master_item_id' => $new->id, 'quantity' => 1]],
        ])
            ->assertOk()
            ->assertJsonPath('data.monthly_price', 900_000);

        $this->assertDatabaseMissing('room_master_item', ['room_id' => $room->id, 'master_item_id' => $old->id]);
        $this->assertDatabaseHas('room_master_item', ['room_id' => $room->id, 'master_item_id' => $new->id]);
    }

    public function test_partial_update_without_items_keeps_existing_items(): void
    {
        $room = Room::factory()->create();
        $item = MasterItem::factory()->create();
        $room->masterItems()->attach($item);

        $this->patchJson("/api/owner/rooms/{$room->id}", ['type' => 'AC'])->assertOk();

        $this->assertDatabaseHas('room_master_item', ['room_id' => $room->id, 'master_item_id' => $item->id]);
    }

    public function test_owner_can_mark_room_as_needs_repair(): void
    {
        $room = Room::factory()->create();

        $this->patchJson("/api/owner/rooms/{$room->id}", ['status' => 'butuh_perbaikan'])
            ->assertOk()
            ->assertJsonPath('data.status', 'butuh_perbaikan');
    }

    public function test_cannot_change_status_of_occupied_room(): void
    {
        $room = Room::factory()->occupied()->create();

        $this->patchJson("/api/owner/rooms/{$room->id}", ['status' => 'kosong'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('status');
    }

    public function test_owner_can_delete_available_room(): void
    {
        $room = Room::factory()->create();

        $this->deleteJson("/api/owner/rooms/{$room->id}")->assertOk();

        $this->assertSoftDeleted($room);
    }

    public function test_cannot_delete_occupied_room(): void
    {
        $room = Room::factory()->occupied()->create();

        $this->deleteJson("/api/owner/rooms/{$room->id}")->assertUnprocessable();

        $this->assertNotSoftDeleted($room);
    }

    public function test_tenant_cannot_manage_rooms(): void
    {
        Sanctum::actingAs(User::factory()->create(['role' => UserRole::Tenant]));

        $this->getJson('/api/owner/rooms')->assertForbidden();
        $this->postJson('/api/owner/rooms', [])->assertForbidden();
    }
}
