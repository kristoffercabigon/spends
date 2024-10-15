<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('source')->insert([
            ['source' => 'GSIS'],
            ['source' => 'SSS'],
            ['source' => 'AFPSLAI'],
            ['source' => 'Others'],
        ]);
    }
}
