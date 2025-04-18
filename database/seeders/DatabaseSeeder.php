<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Remove or comment out the test user
        // User::factory()->create([...]);

        // ✅ Call your real LMS seeder
        $this->call(LmsSeeder::class);
    }
}
