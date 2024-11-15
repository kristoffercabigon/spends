<?php

namespace Database\Factories;

use App\Models\IncomeSource;
use App\Models\Seniors;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class IncomeSourceFactory extends Factory
{
    protected $model = IncomeSource::class;

    public function definition()
    {
        $senior = Seniors::where('permanent_source', 1)->inRandomOrder()->first();

        $maxIncomeSourceId = DB::table('where_income_source_list')->max('id');

        $incomeSourceId = $this->faker->numberBetween(1, $maxIncomeSourceId);

        $otherIncomeSources = [
            'Pagsasaka',
            'Pangingisda',
            'Pagmimina',
            'Paghahabi',
            'Online Selling',
            'Pagtuturo',
            'Pagbalot ng prutas at gulay'
        ];

        return [
            'senior_id' => $senior->id,
            'income_source_id' => $incomeSourceId,
            'other_income_source_remark' => $incomeSourceId === $maxIncomeSourceId ? $this->faker->randomElement($otherIncomeSources) : null,
        ];
    }
}
