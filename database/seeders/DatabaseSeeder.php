<?php

namespace Database\Seeders;

use App\Models\Seniors;
use App\Models\IncomeSource;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LivingArrangementSeeder;
use Database\Seeders\RelationshipSeeder;
use Database\Seeders\BarangaySeeder;
use Database\Seeders\SexSeeder;
use Database\Seeders\CivilStatusSeeder;
use Database\Seeders\SourceSeeder;
use Database\Seeders\SourceDatasSeeder;
use Database\Seeders\PensionSeeder;
use Database\Seeders\IncomeSeeder;
use Database\Seeders\IncomeSourceSeeder;
use Database\Seeders\IncomeSourceDataSeeder;
use Database\Seeders\EncoderSeeder;
use Database\Seeders\SeniorApplicationStatusSeeder;
use Database\Seeders\SeniorAccountStatusSeeder;
use Database\Seeders\UserTypeSeeder;
use Database\Seeders\PensionDistributionSeeder;
use Database\Seeders\FamilyCompositionSeeder;
use Database\Seeders\GuardianSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\EventsSeeder;
use Database\Seeders\EventsImagesSeeder;
use Database\Seeders\ActivityTypesSeeder;
use Database\Seeders\ActivityLogSeeder;
use Database\Seeders\SignInHistorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserTypeSeeder::class);
        $this->call(LivingArrangementSeeder::class);
        $this->call(RelationshipSeeder::class);
        $this->call(BarangaySeeder::class);
        $this->call(SexSeeder::class);
        $this->call(CivilStatusSeeder::class);
        $this->call(SourceSeeder::class);
        $this->call(PensionSeeder::class);
        $this->call(IncomeSeeder::class);
        $this->call(IncomeSourceSeeder::class);
        $this->call(EncoderSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PensionDistributionSeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(EventsImagesSeeder::class);
        $this->call(SeniorApplicationStatusSeeder::class);
        $this->call(SeniorAccountStatusSeeder::class);

        $uniqueOscaIds = collect();

        while ($uniqueOscaIds->count() < 50) {
            $oscaId = fake()->numberBetween(10000, 99999);
            $uniqueOscaIds->add($oscaId);
        }

        $uniqueOscaIds = $uniqueOscaIds->unique();

        foreach ($uniqueOscaIds as $oscaId) {
            $senior = Seniors::factory()->create(['osca_id' => $oscaId]);
            echo "(Senior) Senior ID: {$senior->id}" . PHP_EOL;
        }

        $this->call(GuardianSeeder::class);
        $this->call(FamilyCompositionSeeder::class);
        $this->call(IncomeSourceDataSeeder::class);
        $this->call(SourceDatasSeeder::class);
        $this->call(SignInHistorySeeder::class);
        $this->call(ActivityTypesSeeder::class);
        $this->call(ActivityLogSeeder::class);


        // You can also uncomment and modify the user factory as needed
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

