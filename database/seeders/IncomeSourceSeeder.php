<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incomesources = [
            'Business Income',
            'Rental Income',
            'Employment Income',
            'Farm or Agricultural Income',
            'Annuities or Private Retirement Funds',
            'Others'
        ];

        $incomesources_examples = [
            '(e.g., sari-sari store, carinderia or small eatery, online selling or e-commerce)',
            '(e.g., renting out a house or apartment)',
            '(e.g., salary from a part-time job)',
            '(e.g., profits from selling crops or livestock)',
            '(e.g., monthly payments from a retirement plan)',
        ];

        foreach ($incomesources as $index => $incomesource) {

            $example = isset($incomesources_examples[$index]) ? $incomesources_examples[$index] : null;

            DB::table('where_income_source_list')->insert([
                'where_income_source' => $incomesource,
                'where_income_source_examples' => $example,
            ]);
        }
    }
}
