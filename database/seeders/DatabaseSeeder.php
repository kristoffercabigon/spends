<?php

namespace Database\Seeders;

use App\Models\Seniors;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LivingArrangementSeeder; // Add this line

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LivingArrangementSeeder::class);
        Seniors::factory(10)->create();

        // You can also uncomment and modify the user factory as needed
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

