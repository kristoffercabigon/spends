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
            'Investment Income',
            'Employment Income',
            'Remittances',
            'Farm or Agricultural Income',
            'Annuities or Private Retirement Funds',
            'Financial Assistance Programs',
            'Others'
        ];

        foreach ($incomesources as $incomesource) {
            DB::table('where_income_source_list')->insert([
                'where_income_source' => $incomesource,
            ]);
        }
    }
}
