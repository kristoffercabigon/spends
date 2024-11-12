<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Seniors;

class IncomeSourceFactory extends Factory
{
    protected $model = 'App\Models\IncomeSource';

    public function definition()
    {
        $senior = Seniors::inRandomOrder()->first();

        $permanentSource = $senior->permanent_source;

        $data = [
            'senior_id' => $senior->id,
            'income_source_id' => $this->faker->numberBetween(1, 11),
            'other_income_source_remark' => $permanentSource == 0 ? $this->faker->sentence() : null,
        ];

        if ($permanentSource == 1) {
            $data['other_income_source_remark'] = null;
        }

        return $data;
    }
}
