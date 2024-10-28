<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incomes = [
            'Below 1000 PHP',
            '1,000 - 2,000 PHP',
            '2,001 - 5,000 PHP',
            '5,001 - 10,000 PHP',
            '10,001 - 15,000 PHP',
            '15,001 - 20,000 PHP',
            '20,001 - 30,000 PHP',
            '30,001 - 50,000 PHP',
            '50,001 - 75,000 PHP',
            '75,001 - 100,000 PHP',
            'Above 100,000 PHP'
        ];

        foreach ($incomes as $income) {
            DB::table('how_much_income_list')->insert([
                'how_much_income' => $income,
            ]);
        }
    }
}
