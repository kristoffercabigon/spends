<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LivingArrangementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('living_arrangement_list')->insert([
            ['type_of_living_arrangement_list' => 'Owned'],
            ['type_of_living_arrangement_list' => 'Living Alone'],
            ['type_of_living_arrangement_list' => 'Living with Relatives'],
            ['type_of_living_arrangement_list' => 'Rent'],
            ['type_of_living_arrangement_list' => 'Others'],
        ]);
    }
}
