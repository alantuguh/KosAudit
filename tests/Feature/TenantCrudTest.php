<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TenantCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $owner;

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = User::factory()->create(['role' => UserRole::Owner]);
        Sanctum::actingAs($this->owner);
    }

    private function tenant(array $attributes = []): User
    {
        return User::factory()->create(['role' => UserRole::Tenant, ...$attributes]);
    }

    public function test_owner_can_list_only_tenants(): void
    {
        $this->tenant();
        $this->tenant();

        $this->getJson('/api/owner/tenants')
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonMissing(['email' => $this->owner->email]);
    }

    public function test_owner_can_search_tenants(): void
    {
        $this->tenant(['name' => 'Budi Santoso']);
        $this->tenant(['name' => 'Siti Aminah']);

        $this->getJson('/api/owner/tenants?search=budi')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Budi Santoso');
    }

    public function test_owner_can_create_tenant(): void
    {
        $this->postJson('/api/owner/tenants', [
            'name' => 'Rina',
            'email' => 'rina@example.com',
            'phone' => '081298765432',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ])
            ->assertCreated()
            ->assertJsonPath('data.role', 'tenant');
    }

    public function test_owner_can_view_tenant(): void
    {
        $tenant = $this->tenant();

        $this->getJson("/api/owner/tenants/{$tenant->id}")
            ->assertOk()
            ->assertJsonPath('data.email', $tenant->email);
    }

    public function test_owner_account_is_not_reachable_via_tenant_endpoints(): void
    {
        $this->getJson("/api/owner/tenants/{$this->owner->id}")->assertNotFound();
        $this->deleteJson("/api/owner/tenants/{$this->owner->id}")->assertNotFound();
    }

    public function test_update_without_password_keeps_old_password(): void
    {
        $tenant = $this->tenant();
        $oldHash = $tenant->password;

        $this->patchJson("/api/owner/tenants/{$tenant->id}", ['phone' => '081311112222'])
            ->assertOk()
            ->assertJsonPath('data.phone', '081311112222');

        $this->assertSame($oldHash, $tenant->refresh()->password);
    }

    public function test_changing_password_revokes_tenant_tokens(): void
    {
        $tenant = $this->tenant();
        $tenant->createToken('hp');

        $this->patchJson("/api/owner/tenants/{$tenant->id}", [
            'password' => 'passwordbaru1',
            'password_confirmation' => 'passwordbaru1',
        ])->assertOk();

        $tenant->refresh();
        $this->assertTrue(Hash::check('passwordbaru1', $tenant->password));
        $this->assertCount(0, $tenant->tokens);
    }

    public function test_email_must_stay_unique_on_update(): void
    {
        $tenant = $this->tenant();
        $other = $this->tenant();

        $this->patchJson("/api/owner/tenants/{$tenant->id}", ['email' => $other->email])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('email');
    }

    public function test_owner_can_delete_tenant_and_revoke_tokens(): void
    {
        $tenant = $this->tenant();
        $tenant->createToken('hp');

        $this->deleteJson("/api/owner/tenants/{$tenant->id}")->assertOk();

        $this->assertSoftDeleted($tenant);
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_tenant_cannot_manage_tenants(): void
    {
        Sanctum::actingAs($this->tenant());

        $this->getJson('/api/owner/tenants')->assertForbidden();
    }
}
