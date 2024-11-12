<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeniorAccountStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Active', 'Inactive', 'Disqualified', 'Deactivated'];

        foreach ($statuses as $status) {
            DB::table('senior_account_status_list')->insert([
                'senior_account_status' => $status,
            ]);
        }
    }
}
