<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MasterItemSeeder::class,
            RoomSeeder::class, // butuh MasterItem untuk mengisi pivot
        ]);
    }
}
