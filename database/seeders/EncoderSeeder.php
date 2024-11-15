<?php

namespace Database\Seeders;

use App\Models\Encoder;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EncoderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $MaleNames = [
            'John',
            'Mark',
            'Michael',
            'James',
            'Robert',
            'William',
            'David',
            'Richard',
            'Joseph',
            'Charles',
            'Thomas',
            'Daniel',
            'Matthew',
            'Anthony',
            'Donald',
            'Paul',
            'Andrew',
            'Joshua',
            'Samuel',
            'Kevin',
            'Brian',
            'George',
            'Edward',
            'Ronald',
            'Jack',
            'Jason',
            'Justin',
            'Larry',
            'Scott',
            'Eric',
            'Stephen',
            'Timothy',
            'Adam',
            'Nathan'
        ];

        $FemaleNames = [
            'Mary',
            'Jennifer',
            'Linda',
            'Patricia',
            'Elizabeth',
            'Barbara',
            'Susan',
            'Jessica',
            'Sarah',
            'Margaret',
            'Dorothy',
            'Laura',
            'Helen',
            'Nancy',
            'Karen',
            'Betty',
            'Ruth',
            'Sharon',
            'Kimberly',
            'Deborah',
            'Cynthia',
            'Amy',
            'Angela',
            'Virginia',
            'Diane',
            'Julie',
            'Madison',
            'Sophia',
            'Isabella',
            'Charlotte',
            'Ava',
            'Mia',
            'Emma',
            'Harper',
            'Ella',
            'Olivia',
            'Lily',
            'Grace',
            'Chloe',
            'Zoe',
            'Ruby',
            'Leah',
            'Anna',
            'Lucy',
            'Victoria',
            'Alice',
            'Evelyn',
            'Emily',
            'Hannah',
            'Audrey',
            'Samantha',
            'Hailey',
            'Abigail',
            'Addison',
            'Lillian',
            'Eleanor',
            'Amelia',
            'Madeline',
            'Savannah',
            'Brianna',
            'Penelope',
            'Scarlett',
            'Aria',
            'Alexa',
            'Victoria',
            'Nora',
            'Kayla',
            'Ariana',
            'Brooklyn'
        ];

        $LastNames = [
            'Cabigon',
            'Santiago',
            'Palomares',
            'Tonio',
            'Aquino',
            'Bautista',
            'Cruz',
            'Dela Cruz',
            'Gonzales',
            'Garcia',
            'López',
            'Martinez',
            'Reyes',
            'Santos',
            'Torres',
            'Delos Reyes',
            'Bañez',
            'Flores',
            'Nieves',
            'Salvador',
            'Dizon',
            'Bacani',
            'Velasquez',
            'Cabrera',
            'Pascual',
            'Villanueva',
            'Alvarez',
            'Chua',
            'Sarmiento',
            'Morales',
            'Pineda',
            'Ocampo',
            'Alcantara',
            'Cortez',
            'Alvarado',
            'Mendoza',
            'Labrador',
            'Salinas',
            'Castañeda',
            'De Leon',
            'Vera',
            'Magsaysay',
            'Dela Torre',
            'Ponce',
            'Suarez',
            'Valenzuela',
            'Aguilar',
            'Ramos',
            'Cruzado',
            'Esteban',
            'Sison',
            'Tiongson',
            'San Antonio',
            'Dela Cruz',
            'Del Mundo',
            'De Guzman',
            'De Jesus',
            'De Leon',
            'Delos Santos',
            'De Vera',
            'San Miguel',
            'San Juan',
            'San Pedro',
            'De Ocampo',
            'Del Rosario',
            'De la Torre',
            'De la Cruz',
            'San Vicente',
            'Del Castillo',
            'De la Vega',
            'Bautista',
            'Cruz',
            'Mendoza',
            'Martinez',
            'Riviera',
            'Salas',
            'Rocamora',
            'Santos',
            'Tabujara',
            'Verano',
            'Villanueva',
            'Castillo',
            'Martelino',
            'Misa',
            'Naguit',
            'Alcaraz',
            'Alfonso',
            'Arroyo',
            'Atienza',
            'Bañez',
            'Cabarroguis',
            'Esguerra',
            'Manalo',
            'Matias',
            'Ramos',
            'Villafuerte',
            'Yap',
            'Zaragoza',
            'De Guzman',
            'De la Rosa',
            'Delos Reyes',
            'De Guzman',
            'De Villa',
            'Gumabay',
            'Lacuna',
            'Macapagal',
            'Manalaysay',
            'Natividad',
            'Rosales',
            'Soriano',
        ];

        $numberOfRecords = 10;
        $usedEncoderIds = [];

        for ($i = 0; $i < $numberOfRecords; $i++) {
            do {
                $encoderId = rand(1000, 9999);
            } while (in_array($encoderId, $usedEncoderIds));

            $usedEncoderIds[] = $encoderId;

            if ($i === 0) {

                Encoder::create([
                    'encoder_id' => $encoderId,
                    'encoder_user_type_id' => 2,
                    'encoder_first_name' => 'Kristoffer',
                    'encoder_middle_name' => 'Dela Cruz',
                    'encoder_last_name' => 'Cabigon',
                    'encoder_suffix' => null, 
                    'encoder_email' => 'kristoffercabigon@gmail.com',
                    'encoder_password' => bcrypt('Abaayos!'),
                    'encoder_verified_at' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                    'encoder_date_registered' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                ]);
            } else {
                $isMale = rand(0, 1) == 0;
                $firstName = fake()->randomElement($isMale ? $MaleNames : $FemaleNames);

                $middleName = fake()->optional(0.5)->randomElement($LastNames);
                $lastName = fake()->randomElement($LastNames);

                $suffix = $isMale ? fake()->optional(0.5)->randomElement(['Jr.', 'Sr.', 'I', 'II', 'III']) : null;

                $email = strtolower(str_replace(' ', '', $firstName)) .
                    strtolower(str_replace(' ', '', $middleName ?? '')) .
                    strtolower(str_replace(' ', '', $lastName)) .
                    ($suffix ? strtolower(str_replace(' ', '', $suffix)) : '') .
                    rand(10, 99) . '@example.com';

                Encoder::create([
                    'encoder_id' => $encoderId,
                    'encoder_user_type_id' => 2,
                    'encoder_first_name' => $firstName,
                    'encoder_middle_name' => $middleName,
                    'encoder_last_name' => $lastName,
                    'encoder_suffix' => $suffix,
                    'encoder_email' => $email,
                    'encoder_password' => bcrypt('password'),
                    'encoder_verified_at' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                    'encoder_date_registered' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
