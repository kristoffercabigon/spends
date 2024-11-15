<?php

namespace Database\Seeders;

use App\Models\FamilyComposition;
use App\Models\Seniors;
use Illuminate\Database\Seeder;

class FamilyCompositionSeeder extends Seeder
{
    public function run(): void
    {
        $relationships = [
            'Child' => [1, 30],
            'Grandchild' => [1, 30],
            'Sibling' => [30, 100],
            'Spouse' => [30, 100],
            'Parent' => [30, 100],
            'Aunt' => [30, 80],
            'Uncle' => [30, 80],
            'Niece' => [1, 40],
            'Nephew' => [1, 40],
            'Cousin' => [10, 80],
            'Grandparent' => [60, 100],
            'Mother-in-law' => [40, 90],
            'Father-in-law' => [40, 90],
            'Brother-in-law' => [30, 80],
            'Sister-in-law' => [30, 80],
            'Stepchild' => [1, 30],
            'Stepparent' => [30, 100],
            'Stepsibling' => [1, 80],
        ];

        $occupationIncomeRanges = [
            'Farmer' => [5000, 15000],
            'Teacher' => [15000, 35000],
            'Engineer' => [20000, 50000],
            'Doctor' => [50000, 150000],
            'Nurse' => [20000, 40000],
            'Salesperson' => [10000, 30000],
            'Accountant' => [20000, 50000],
            'Carpenter' => [10000, 25000],
            'Electrician' => [15000, 30000],
            'Chef' => [15000, 35000],
            'Mechanic' => [15000, 35000],
            'Lawyer' => [30000, 100000],
            'Scientist' => [30000, 80000],
            'Artist' => [10000, 40000],
            'Musician' => [10000, 40000],
            'Software Developer' => [30000, 80000],
            'Nanny' => [10000, 25000],
            'Construction Worker' => [15000, 35000],
            'Designer' => [20000, 50000],
            'Architect' => [25000, 70000],
            'Pilot' => [50000, 150000],
            'Bus Driver' => [15000, 35000],
            'Retail Worker' => [10000, 20000],
            'Dentist' => [50000, 120000],
            'Retired' => [0, 0],
            'Consultant' => [25000, 100000],
            'Intern' => [5000, 15000],
            'Junior Developer' => [15000, 30000],
            'Freelancer' => [5000, 50000],
            'Photographer' => [10000, 30000],
            'Social Media Manager' => [15000, 40000],
            'Graphic Designer' => [15000, 35000],
            'Content Creator' => [5000, 30000],
            'Writer' => [10000, 30000],
            'Virtual Assistant' => [10000, 25000],
            'Web Developer' => [25000, 70000]
        ];

        $seniors = Seniors::all();

        foreach ($seniors as $senior) {
            if (rand(1, 100) <= 95) {
                continue;
            }

            $familyMemberCount = (rand(1, 2) == 1) ? rand(5, 10) : rand(1, 4);

            for ($i = 0; $i < $familyMemberCount; $i++) {
                $relativeFirstName = fake()->firstName;
                $relativeLastName = $senior->last_name;
                $relativeName = $relativeFirstName . ' ' . $relativeLastName;

                $relationship = fake()->randomElement(array_keys($relationships));
                $ageRange = $relationships[$relationship];
                $relativeAge = rand($ageRange[0], $ageRange[1]);

                if ($relativeAge < 18) {
                    $civilStatus = 1;
                    $occupation = 'Student';
                    $relativeIncome = rand(0, 5000);
                } elseif ($relativeAge >= 18 && $relativeAge < 30) {
                    $civilStatus = rand(1, 4);
                    $occupation = (rand(1, 100) <= 25) ? null : fake()->randomElement(['Intern', 'Junior Developer', 'Salesperson', 'Artist', 'Freelancer', 'Part-time Job', 'Photographer', 'Social Media Manager', 'Graphic Designer', 'Content Creator', 'Virtual Assistant']);
                    $relativeIncome = $occupation && isset($occupationIncomeRanges[$occupation]) ? rand($occupationIncomeRanges[$occupation][0], $occupationIncomeRanges[$occupation][1]) : null;
                } elseif ($relativeAge >= 30 && $relativeAge < 60) {
                    $civilStatus = rand(1, 4);
                    $occupation = (rand(1, 100) <= 50) ? null : fake()->randomElement(array_keys($occupationIncomeRanges));
                    $relativeIncome = $occupation && isset($occupationIncomeRanges[$occupation]) ? rand($occupationIncomeRanges[$occupation][0], $occupationIncomeRanges[$occupation][1]) : null;
                } else {
                    $civilStatus = rand(2, 4);
                    $occupation = (rand(1, 100) <= 75) ? null : fake()->randomElement(['Retired', 'Consultant']);
                    $relativeIncome = $occupation && isset($occupationIncomeRanges[$occupation]) ? rand($occupationIncomeRanges[$occupation][0], $occupationIncomeRanges[$occupation][1]) : null;
                }

                FamilyComposition::create([
                    'senior_id' => $senior->id,
                    'relative_name' => $relativeName,
                    'relative_relationship' => $relationship,
                    'relative_age' => $relativeAge,
                    'relative_civil_status' => $civilStatus,
                    'relative_occupation' => $occupation,
                    'relative_income' => $relativeIncome,
                ]);
            }
        }
    }
}
