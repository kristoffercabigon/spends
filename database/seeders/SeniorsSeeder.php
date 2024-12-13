<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\FamilyCompositionSeeder;
use Database\Seeders\GuardianSeeder;
use Database\Seeders\IncomeSourceDataSeeder;
use Database\Seeders\SourceDatasSeeder;
use App\Models\Seniors;

class SeniorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uniqueOscaIds = collect();

        while ($uniqueOscaIds->count() < 1000) {
            $oscaId = fake()->numberBetween(10000, 99999);
            $uniqueOscaIds->add($oscaId);
        }

        $uniqueOscaIds = $uniqueOscaIds->unique();

        foreach ($uniqueOscaIds as $oscaId) {
            Seniors::factory()->create(['osca_id' => $oscaId]);
        }

        $this->call(GuardianSeeder::class);
        $this->call(FamilyCompositionSeeder::class);
        $this->call(IncomeSourceDataSeeder::class);
        $this->call(SourceDatasSeeder::class);
    }
}
