<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seniors;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IncomeSourceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Seniors::factory()->count(10)->create()->each(function ($senior) use ($faker) {

            $incomeSourceData = [
                'senior_id' => $senior->id,
                'income_source_id' => rand(1, 11),
                'other_income_source_remark' => $senior->permanent_source == 0 ? $faker->sentence() : null,
            ];

            DB::table('income_source')->insert($incomeSourceData);
        });
    }
}
