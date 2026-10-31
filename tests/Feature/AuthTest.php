<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private function owner(): User
    {
        return User::factory()->create(['role' => UserRole::Owner]);
    }

    private function tenant(): User
    {
        return User::factory()->create(['role' => UserRole::Tenant]);
    }

    // ------------------------------------------------------------------
    // Login
    // ------------------------------------------------------------------

    public function test_user_can_login_with_valid_credentials(): void
    {
        $owner = $this->owner(); // password bawaan factory: "password"

        $this->postJson('/api/auth/login', [
            'email' => $owner->email,
            'password' => 'password',
        ])
            ->assertOk()
            ->assertJsonStructure(['message', 'token', 'token_type', 'user' => ['id', 'email', 'role']])
            ->assertJsonPath('user.role', 'owner');
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $owner = $this->owner();

        $this->postJson('/api/auth/login', [
            'email' => $owner->email,
            'password' => 'salah-total',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('email');
    }

    public function test_login_response_never_exposes_password(): void
    {
        $owner = $this->owner();

        $this->postJson('/api/auth/login', [
            'email' => $owner->email,
            'password' => 'password',
        ])->assertJsonMissingPath('user.password');
    }

    // ------------------------------------------------------------------
    // Me & Logout
    // ------------------------------------------------------------------

    public function test_guest_cannot_access_me(): void
    {
        $this->getJson('/api/auth/me')->assertUnauthorized();
    }

    public function test_authenticated_user_can_get_profile(): void
    {
        Sanctum::actingAs($tenant = $this->tenant());

        $this->getJson('/api/auth/me')
            ->assertOk()
            ->assertJsonPath('data.email', $tenant->email);
    }

    public function test_logout_revokes_current_token(): void
    {
        $owner = $this->owner();
        $token = $owner->createToken('test')->plainTextToken;

        $this->withToken($token)->postJson('/api/auth/logout')->assertOk();

        $this->assertDatabaseCount('personal_access_tokens', 0);

        // Guard menyimpan user di memori selama satu test; reset agar token dicek ulang.
        $this->app['auth']->forgetGuards();

        $this->withToken($token)->getJson('/api/auth/me')->assertUnauthorized();
    }

    // ------------------------------------------------------------------
    // Register penghuni (khusus Owner)
    // ------------------------------------------------------------------

    public function test_owner_can_register_tenant(): void
    {
        Sanctum::actingAs($this->owner());

        $this->postJson('/api/auth/register', [
            'name' => 'Siti Penghuni',
            'email' => 'siti@example.com',
            'phone' => '081234567890',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ])
            ->assertCreated()
            ->assertJsonPath('data.role', 'tenant');

        $this->assertDatabaseHas('users', ['email' => 'siti@example.com', 'role' => 'tenant']);
    }

    public function test_owner_cannot_register_another_owner_via_role_field(): void
    {
        Sanctum::actingAs($this->owner());

        $this->postJson('/api/auth/register', [
            'name' => 'Penyusup',
            'email' => 'penyusup@example.com',
            'phone' => '081234567891',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'role' => 'owner', // harus diabaikan
        ])->assertCreated();

        $this->assertDatabaseHas('users', ['email' => 'penyusup@example.com', 'role' => 'tenant']);
    }

    public function test_tenant_cannot_register_users(): void
    {
        Sanctum::actingAs($this->tenant());

        $this->postJson('/api/auth/register', [
            'name' => 'X',
            'email' => 'x@example.com',
            'phone' => '081234567892',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ])->assertForbidden();
    }

    public function test_register_validates_input(): void
    {
        Sanctum::actingAs($this->owner());

        $this->postJson('/api/auth/register', [
            'email' => 'bukan-email',
            'phone' => '12345',
            'password' => 'pendek',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'phone', 'password']);
    }

    // ------------------------------------------------------------------
    // Middleware role
    // ------------------------------------------------------------------

    public function test_owner_can_access_owner_dashboard(): void
    {
        Sanctum::actingAs($this->owner());

        $this->getJson('/api/owner/dashboard')
            ->assertOk()
            ->assertJsonStructure(['summary' => ['total_rooms', 'rooms_by_status', 'total_tenants', 'total_master_items']]);
    }

    public function test_tenant_cannot_access_owner_dashboard(): void
    {
        Sanctum::actingAs($this->tenant());

        $this->getJson('/api/owner/dashboard')->assertForbidden();
    }

    public function test_owner_cannot_access_tenant_dashboard(): void
    {
        Sanctum::actingAs($this->owner());

        $this->getJson('/api/tenant/dashboard')->assertForbidden();
    }

    public function test_api_returns_json_even_without_accept_header(): void
    {
        // Tanpa getJson(): memastikan ForceJsonResponse bekerja.
        $this->get('/api/owner/dashboard')
            ->assertUnauthorized()
            ->assertJson(['message' => 'Unauthenticated.']);
    }
}
