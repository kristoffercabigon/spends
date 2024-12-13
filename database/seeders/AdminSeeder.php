<?php

namespace Database\Seeders;

use App\Models\Admin; 
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Admin::create([
            'admin_id' => rand(1000, 9999), 
            'admin_user_type_id' => 3,  
            'admin_first_name' => 'Kristoffer',
            'admin_middle_name' => 'Dela Cruz',
            'admin_last_name' => 'Cabigon',
            'admin_suffix' => null,  
            'admin_email' => 'kristoffercabigon@gmail.com',
            'admin_profile_picture' => 'sample18.jpg',
            'admin_password' => bcrypt('Abaayos!'),
            'admin_verified_at' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
            'admin_date_registered' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
        ]);
    }
}
