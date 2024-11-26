<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EncoderRolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['encoder_role' => 'View Beneficiary List', 'encoder_role_category' => 'View'],
            ['encoder_role' => 'View Beneficiary Profile', 'encoder_role_category' => 'View'],
            ['encoder_role' => 'View Application List', 'encoder_role_category' => 'View'],
            ['encoder_role' => 'View Pension Distribution List', 'encoder_role_category' => 'View'],
            ['encoder_role' => 'Create Beneficiary', 'encoder_role_category' => 'Create'],
            ['encoder_role' => 'Create Pension Distribution Program', 'encoder_role_category' => 'Create'],
            ['encoder_role' => 'Create Events', 'encoder_role_category' => 'Create'],
            ['encoder_role' => 'Update Beneficiary Profile', 'encoder_role_category' => 'Update'],
            ['encoder_role' => 'Update Account Status of Senior', 'encoder_role_category' => 'Update'],
            ['encoder_role' => 'Update Application Status of Senior', 'encoder_role_category' => 'Update'],
            ['encoder_role' => 'Update Pension Distribution Program', 'encoder_role_category' => 'Update'],
            ['encoder_role' => 'Update Events', 'encoder_role_category' => 'Update'],
            ['encoder_role' => 'Delete Beneficiary', 'encoder_role_category' => 'Delete'],
            ['encoder_role' => 'Delete Pension Distribution Program', 'encoder_role_category' => 'Delete'],
            ['encoder_role' => 'Delete Events', 'encoder_role_category' => 'Delete'],
        ];

        DB::table('encoder_roles_list')->insert($roles);
    }
}
