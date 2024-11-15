<?php

namespace Database\Seeders;

use App\Models\Encoder;
use App\Models\EncoderRoles;
use Illuminate\Database\Seeder;

class EncoderRolesDatasSeeder extends Seeder
{
    public function run(): void
    {
        $encoders = Encoder::all();
        $roleIds = [1, 2, 3];

        foreach ($encoders as $encoder) {
            $roles = array_rand(array_flip($roleIds), rand(1, count($roleIds)));

            if (!is_array($roles)) {
                $roles = [$roles];
            }

            foreach ($roles as $role) {
                EncoderRoles::create([
                    'encoder_user_id' => $encoder->id,
                    'encoder_roles_id' => $role,
                ]);
            }
        }
    }
}
