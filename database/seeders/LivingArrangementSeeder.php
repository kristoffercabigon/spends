<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LivingArrangementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('living_arrangement')->insert([
            ['type_of_living_arrangement' => 'Owned'],
            ['type_of_living_arrangement' => 'Living Alone'],
            ['type_of_living_arrangement' => 'Living with Relatives'],
            ['type_of_living_arrangement' => 'Rent'],
            ['type_of_living_arrangement' => 'Others'],
        ]);
    }
}
