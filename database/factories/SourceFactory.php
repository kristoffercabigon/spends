<?php

namespace Database\Factories;

use App\Models\Source;
use App\Models\Seniors;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class SourceFactory extends Factory
{
    protected $model = Source::class;

    public function definition()
    {
        $senior = Seniors::where('pensioner', 1)->inRandomOrder()->first();

        $maxSourceId = DB::table('source_list')->max('id');

        $sourceId = $this->faker->numberBetween(1, $maxSourceId);

        $otherSources = [
            'Philippine Veterans Affairs Office (PVAO)',
            'Overseas Workers Welfare Administration (OWWA)',
            'Private Company Pension Plans',
            'Pag-IBIG Fund (Home Development Mutual Fund)',
            'Mutual Aid or Cooperative Pensions'
        ];

        return [
            'senior_id' => $senior->id,
            'source_id' => $sourceId,
            'other_source_remark' => $sourceId === $maxSourceId ? $this->faker->randomElement($otherSources) : null,
        ];
    }
}
