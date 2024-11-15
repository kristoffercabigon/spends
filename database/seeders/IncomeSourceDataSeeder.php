<?php

namespace Database\Seeders;

use App\Models\IncomeSource;
use App\Models\Seniors;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSourceDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $otherIncomeSources = [
            'Pagsasaka',
            'Pangingisda',
            'Pagmimina',
            'Paghahabi',
            'Online Selling',
            'Pagtuturo',
            'Pagbalot ng prutas at gulay'
        ];

        $maxIncomeSourceId = DB::table('where_income_source_list')->max('id');

        $seniors = Seniors::where('permanent_source', 1)->get();

        foreach ($seniors as $senior) {
            $incomeSourceIds = range(1, $maxIncomeSourceId);

            $incomeSourceCount = rand(1, 3);

            for ($i = 0; $i < $incomeSourceCount; $i++) {
                $incomeSourceId = array_splice($incomeSourceIds, array_rand($incomeSourceIds), 1)[0];

                IncomeSource::factory()->create([
                    'senior_id' => $senior->id,
                    'income_source_id' => $incomeSourceId,
                    'other_income_source_remark' => $incomeSourceId === $maxIncomeSourceId ? fake()->randomElement($otherIncomeSources) : null,
                ]);
            }
        }
    }
}
