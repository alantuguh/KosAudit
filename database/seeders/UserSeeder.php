<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Password di-hash otomatis oleh cast 'hashed' di model User.
        User::updateOrCreate(
            ['email' => 'owner@kosaudit.test'],
            [
                'name' => 'Pemilik Kos',
                'phone' => '081200000001',
                'role' => UserRole::Owner,
                'password' => 'password',
                'email_verified_at' => now(),
            ],
        );

        User::updateOrCreate(
            ['email' => 'tenant@kosaudit.test'],
            [
                'name' => 'Budi Penghuni',
                'phone' => '081200000002',
                'role' => UserRole::Tenant,
                'password' => 'password',
                'email_verified_at' => now(),
            ],
        );
    }
}
