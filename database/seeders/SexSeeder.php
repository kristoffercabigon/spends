<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexSeeder extends Seeder
{
    public function run(): void
    {
        $sexOptions = ['Male', 'Female'];

        foreach ($sexOptions as $sex) {
            DB::table('sex_list')->insert([
                'sex' => $sex,
            ]);
        }
    }
}

