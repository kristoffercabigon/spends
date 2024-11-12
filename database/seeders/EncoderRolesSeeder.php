<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EncoderRolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Create', 'Edit', 'Delete'];

        foreach ($roles as $role) {
            DB::table('encoder_roles_list')->insert([
                'encoder_role' => $role,
            ]);
        }
    }
}
