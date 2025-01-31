<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\TeamSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TeamSeeder::class, // Llama al seeder de Team
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@info.com',
        ]);
    }
}
