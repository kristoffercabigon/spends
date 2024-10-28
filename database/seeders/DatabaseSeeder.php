<?php

namespace Database\Seeders;

use App\Models\Seniors;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LivingArrangementSeeder;
use Database\Seeders\BarangaySeeder;
use Database\Seeders\SexSeeder;
use Database\Seeders\CivilStatusSeeder;
use Database\Seeders\SourceSeeder;
use Database\Seeders\PensionSeeder;
use Database\Seeders\IncomeSeeder;
use Database\Seeders\IncomeSourceSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LivingArrangementSeeder::class);
        $this->call(BarangaySeeder::class);
        $this->call(SexSeeder::class);
        $this->call(CivilStatusSeeder::class);
        $this->call(SourceSeeder::class);
        $this->call(PensionSeeder::class);
        $this->call(IncomeSeeder::class);
        $this->call(IncomeSourceSeeder::class);
        Seniors::factory(10)->create();

        // You can also uncomment and modify the user factory as needed
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

