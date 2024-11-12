<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserTypeSeeder extends Seeder
{
    public function run(): void
    {
        $UserTypes = ['Senior', 'Encoder', 'Admin'];

        foreach ($UserTypes as $UserType) {
            DB::table('user_type_list')->insert([
                'user_type' => $UserType,
            ]);
        }
    }
}
