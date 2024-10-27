<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pensions = ['Below 1000 PHP',
            '1,000 - 2,000 PHP', 
            '2,001 - 3,000 PHP',
            '3,001 - 4,000 PHP',
            '4,001 - 5,000 PHP',
            '5,001 - 6,000 PHP',
            '6,001 - 7,000 PHP',
            '7,001 - 8,000 PHP',
            '8,001 - 9,000 PHP',
            '9,001 - 10,000 PHP',
            'Above 10,000 PHP'
        ];

        foreach ($pensions as $pension) {
            DB::table('how_much_pension_list')->insert([
                'how_much_pension' => $pension,
            ]);
        }
    }
}
