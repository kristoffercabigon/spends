<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeniorApplicationStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Under Evaluation', 'On Hold', 'Approved', 'Disapproved'];

        foreach ($statuses as $status) {
            DB::table('senior_application_status_list')->insert([
                'senior_application_status' => $status,
            ]);
        }
    }
}
