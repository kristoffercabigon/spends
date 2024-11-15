<?php

namespace Database\Seeders;

use App\Models\Source;
use App\Models\Seniors;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceDatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $otherSources = [
            'Philippine Veterans Affairs Office (PVAO)',
            'Overseas Workers Welfare Administration (OWWA)',
            'Private Company Pension Plans',
            'Pag-IBIG Fund (Home Development Mutual Fund)',
            'Mutual Aid or Cooperative Pensions'
        ];

        $seniors = Seniors::where('pensioner', 1)->get();

        $maxSourceId = DB::table('source_list')->max('id');

        foreach ($seniors as $senior) {
            $SourceIds = range(1, $maxSourceId);

            $SourceCount = rand(1, 3);

            for ($i = 0; $i < $SourceCount; $i++) {
                $SourceId = array_splice($SourceIds, array_rand($SourceIds), 1)[0];

                Source::factory()->create([
                    'senior_id' => $senior->id,
                    'source_id' => $SourceId,
                    'other_source_remark' => $SourceId === $maxSourceId ? fake()->randomElement($otherSources) : null,
                ]);
            }
        }
    }
}

