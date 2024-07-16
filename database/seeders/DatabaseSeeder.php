<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GeoJsonData;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@tracking.it',
            'password' => 'password'
        ]);

    }
}
