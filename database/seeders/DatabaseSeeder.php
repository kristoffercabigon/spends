<?php

namespace Database\Seeders;

use App\Models\Seniors;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LivingArrangementSeeder;
use Database\Seeders\BarangaySeeder;
use Database\Seeders\CitizenshipSeeder;
use Database\Seeders\SexSeeder;
use Database\Seeders\CivilStatusSeeder;
use Database\Seeders\SourceSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LivingArrangementSeeder::class);
        $this->call(BarangaySeeder::class);
        $this->call(CitizenshipSeeder::class);
        $this->call(SexSeeder::class);
        $this->call(CivilStatusSeeder::class);
        $this->call(SourceSeeder::class);
        Seniors::factory(10)->create();

        // You can also uncomment and modify the user factory as needed
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

