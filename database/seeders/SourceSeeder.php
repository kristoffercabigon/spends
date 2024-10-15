<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('source_list')->insert([
            ['source_list' => 'GSIS'],
            ['source_list' => 'SSS'],
            ['source_list' => 'AFPSLAI'],
            ['source_list' => 'Others'],
        ]);
    }
}
