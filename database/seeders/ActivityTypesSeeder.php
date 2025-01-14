<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activityTypes = [
            ['activity_type' => 'Create'],
            ['activity_type' => 'Update'],
            ['activity_type' => 'Delete'],
        ];

        DB::table('activity_types')->insert($activityTypes);
    }
}
