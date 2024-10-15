<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CivilStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Single', 'Married', 'Divorced', 'Widowed'];

        foreach ($statuses as $status) {
            DB::table('civil_status')->insert([
                'civil_status' => $status,
            ]);
        }
    }
}
