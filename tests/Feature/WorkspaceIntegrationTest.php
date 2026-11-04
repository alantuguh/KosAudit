<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\MasterItem;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkspaceIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_pages_require_an_owner_session(): void
    {
        $this->get('/kamar')->assertRedirect(route('login'));
        $this->get('/penghuni')->assertRedirect(route('login'));

        $tenant = User::factory()->create(['role' => UserRole::Tenant]);
        $this->actingAs($tenant)->get('/kamar')->assertForbidden();

        $this->actingAs(User::factory()->create(['role' => UserRole::Owner]))
            ->get('/kamar')
            ->assertOk()
            ->assertSee('Data Kamar')
            ->assertDontSee('Portal Penghuni');
    }

    public function test_owner_login_uses_the_backend_credentials_and_role(): void
    {
        $owner = User::factory()->create(['role' => UserRole::Owner]);

        $this->post('/login', [
            'email' => $owner->email,
            'password' => 'password',
            'role' => 'owner',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($owner);
    }

    public function test_tenant_login_uses_the_backend_account_and_opens_preview_portal(): void
    {
        $tenant = User::factory()->create(['role' => UserRole::Tenant]);

        $this->post('/login', [
            'email' => $tenant->email,
            'password' => 'password',
            'role' => 'tenant',
        ])->assertRedirect(route('portal.dashboard'));

        $this->get('/portal-penghuni')
            ->assertOk()
            ->assertSee('Tenant API saat ini menyediakan profil akun saja.')
            ->assertSee('Portal Penghuni')
            ->assertSee('Dashboard Penghuni')
            ->assertDontSee('Data Kamar')
            ->assertDontSee('Perhitungan Deposit');
    }

    public function test_owner_room_screen_reads_backend_rooms_and_items(): void
    {
        $owner = User::factory()->create(['role' => UserRole::Owner]);
        $room = Room::factory()->create(['room_number' => '901']);
        $room->masterItems()->attach(MasterItem::factory()->create(['name' => 'Kasur']));

        $this->actingAs($owner)
            ->get('/kamar')
            ->assertOk()
            ->assertSee('Kamar 901')
            ->assertSee('Kasur');
    }

    public function test_owner_can_create_room_from_the_workspace_form(): void
    {
        $owner = User::factory()->create(['role' => UserRole::Owner]);
        $item = MasterItem::factory()->create();

        $this->actingAs($owner)
            ->post('/kamar', [
                'room_number' => '902',
                'type' => 'Standar',
                'monthly_price' => 900_000,
                'items' => [
                    ['master_item_id' => $item->id, 'quantity' => 2],
                ],
            ])
            ->assertRedirect(route('kamar.index'));

        $room = Room::where('room_number', '902')->firstOrFail();
        $this->assertDatabaseHas('room_master_item', [
            'room_id' => $room->id,
            'master_item_id' => $item->id,
            'quantity' => 2,
        ]);
    }

    public function test_owner_can_create_a_tenant_account_from_the_workspace_form(): void
    {
        $owner = User::factory()->create(['role' => UserRole::Owner]);

        $this->actingAs($owner)
            ->post('/penghuni', [
                'name' => 'Rina Wulandari',
                'email' => 'rina@example.test',
                'phone' => '081234567890',
                'password' => 'rahasia123',
                'password_confirmation' => 'rahasia123',
            ])
            ->assertRedirect(route('penghuni.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'rina@example.test',
            'role' => UserRole::Tenant->value,
        ]);
    }

    public function test_owner_workspace_pages_render_with_backend_data(): void
    {
        $owner = User::factory()->create(['role' => UserRole::Owner]);
        Room::factory()->create(['room_number' => '903']);

        foreach ([
            '/',
            '/kamar',
            '/kamar/903',
            '/penghuni',
            '/sewa',
            '/inspeksi/form',
            '/inspeksi/komparasi',
            '/deposit/perhitungan',
        ] as $uri) {
            $this->actingAs($owner)->get($uri)->assertOk();
        }
    }

    public function test_tenant_mobile_preview_pages_render(): void
    {
        $tenant = User::factory()->create(['role' => UserRole::Tenant]);

        foreach (['/m/beranda', '/m/kondisi', '/m/deposit'] as $uri) {
            $this->actingAs($tenant)->get($uri)->assertOk();
        }
    }
}
