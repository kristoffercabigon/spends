<?php

namespace Database\Seeders;

use App\Models\Seniors;
use App\Models\Guardian;
use Illuminate\Database\Seeder;

class GuardianSeeder extends Seeder
{
    public function run(): void
    {
        $relationships = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            12,
            13,
            14,
            15,
            16,
            17,
            18
        ];

        $seniors = Seniors::all();

        foreach ($seniors as $senior) {
            echo "(Guardian) Processing Senior ID: {$senior->id}" . PHP_EOL;

            $guardianFirstName = fake()->firstName;
            $guardianLastName = $senior->last_name;
            $guardianMiddleName = fake()->randomElement([fake()->firstName, null]);
            $guardianSuffix = fake()->randomElement(['Jr.', 'Sr.', 'III', null]);
            $guardianRelationshipId = fake()->randomElement($relationships);
            $guardianContactNo = '+639' . fake()->numerify('#########');

            Guardian::create([
                'senior_id' => $senior->id,
                'guardian_first_name' => $guardianFirstName,
                'guardian_middle_name' => $guardianMiddleName,
                'guardian_last_name' => $guardianLastName,
                'guardian_suffix' => $guardianSuffix,
                'guardian_relationship_id' => $guardianRelationshipId,
                'guardian_contact_no' => $guardianContactNo,
            ]);
        }
    }
}
