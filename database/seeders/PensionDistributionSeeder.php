<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PensionDistributionSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $venues = [
            'Covered Court',
            'Health Center',
            'Barangay Hall',
            'Community Gymnasium',
            'Senior Citizen Hall',
            'Municipal Auditorium',
            'Park Pavilion',
            'Multi-purpose Hall',
            'Cultural Center',
            'Recreation Center',
            'City Plaza',
            'Municipal Covered Gym',
            'Barangay Multi-purpose Court',
            'Sports Complex',
            'Community Health Office',
            'Town Hall',
            'Public Market Covered Area',
            'Barangay Satellite Office',
            'Municipal Civic Center',
            'Open Basketball Court',
            'Barangay Chapel Grounds',
            'Senior Citizen Activity Center',
            'Barangay Assembly Hall',
            'Barangay Function Room',
            'Municipal Training Center',
            'Barangay Covered Walkway',
            'Public Library Hall',
            'OSCA Main Office Grounds',
            'Barangay Clustered Gym',
            'Public School Gymnasium',
        ];

        $currentDate = now()->subMonth()->startOfMonth();
        $totalDays = 100;
        $dayCount = 0;

        while ($dayCount < $totalDays) {
            $barangay_id = $faker->numberBetween(1, 29);
            $daysForBarangay = $faker->numberBetween(1, 3);
            $daysForBarangay = min($daysForBarangay, $totalDays - $dayCount);

            foreach (range(1, $daysForBarangay) as $day) {
                $pension_user_type_id = $faker->numberBetween(2, 3);
                $pension_encoder_id = null;
                $pension_admin_id = null;

                if ($pension_user_type_id === 2) {
                    $pension_encoder_id = $faker->numberBetween(1, 30);
                } elseif ($pension_user_type_id === 3) {
                    $pension_admin_id = 1;
                }

                $hour = $faker->numberBetween(8, 9);
                $minute = $faker->randomElement([0, 10, 20, 30, 40, 50]);
                $time = sprintf('%02d:%02d:00', $hour, $minute);

                $date = $currentDate->copy()->addDays($dayCount);
                $dateTime = "{$date->format('Y-m-d')} {$time}";

                $endHour = $faker->randomElement([16, 17]); 
                $endMinute = ($endHour === 16)
                    ? $faker->randomElement([0, 10, 20, 30, 40, 50])
                    : 0; 
                $endtime = sprintf('%02d:%02d:00', $endHour, $endMinute);

                DB::table('pension_distribution_list')->insert([
                    'barangay_id' => $barangay_id,
                    'venue' => $faker->randomElement($venues),
                    'date_of_distribution' => $dateTime,
                    'end_time' => $endtime,
                    'pension_user_type_id' => $pension_user_type_id,
                    'pension_encoder_id' => $pension_encoder_id,
                    'pension_admin_id' => $pension_admin_id,
                ]);

                $dayCount++;
                if ($dayCount >= $totalDays) {
                    break;
                }
            }
        }
    }
}
