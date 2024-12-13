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

        $barangays = [
            'Barangay 165',
            'Barangay 166',
            'Barangay 167',
            'Barangay 168',
            'Barangay 169',
            'Barangay 170',
            'Barangay 171',
            'Barangay 172',
            'Barangay 173',
            'Barangay 174',
            'Barangay 175',
            'Barangay 176-A',
            'Barangay 176-B',
            'Barangay 176-C',
            'Barangay 176-D',
            'Barangay 176-E',
            'Barangay 176-F',
            'Barangay 177',
            'Barangay 178',
            'Barangay 179',
            'Barangay 180',
            'Barangay 181',
            'Barangay 182',
            'Barangay 183',
            'Barangay 184'
        ];

        $filipinoStreet = [
            'Maligaya Street',
            'Mabait Drive',
            'Malolos Avenue',
            'Daisy Road',
            'Camia Boulevard',
            'Sampaguita Street',
            'Rosal Drive',
            'Ruby Avenue',
            'Emerald Boulevard',
            'Gemini Street',
            'Sunflower Drive',
            'Tulip Road',
            'Jade Avenue',
            'Pearl Boulevard',
            'Santos Street',
            'Magnolia Avenue',
            'Ilang-Ilang Drive',
            'Waling-Waling Boulevard',
            'Champaca Street',
            'Dama de Noche Avenue',
            'Venus Road',
            'Saturn Street',
            'Mars Drive',
            'Orion Boulevard',
            'Aurora Avenue',
            'Luna Street',
            'Kalayaan Drive',
            'Masaya Road',
            'Pag-asa Street',
            'Matahimik Avenue',
            'Makisig Boulevard',
            'Marangal Drive',
            'Magiting Street',
            'Mabuhay Road',
            'Mapayapa Avenue',
            'Matatag Drive',
            'Matapat Boulevard',
            'Matamis Street',
            'Mahinhin Drive',
            'Maharlika Avenue',
            'Anahaw Road',
            'Acacia Street',
            'Yakal Boulevard',
            'Narra Drive',
            'Kamagong Street',
            'Molave Avenue',
            'Banaba Road',
            'Talisay Drive',
            'Santol Street',
            'Mangga Avenue',
            'Bayabas Drive',
            'Makopa Street',
            'Kalamansi Road',
            'Atis Drive',
            'Langka Street',
            'Papaya Boulevard',
            'Guyabano Avenue',
            'Siniguelas Drive',
            'Avocado Street',
            'Chico Road',
            'Guava Drive',
            'Balete Boulevard',
            'Pineapple Avenue',
            'Cherry Drive',
            'Rambutan Street',
            'Dalandan Road',
            'Jasmine Street',
            'Azucena Drive',
            'Gardenia Boulevard',
            'Lily Avenue',
            'Poinsettia Street',
            'Gumamela Drive',
            'Hydrangea Road',
            'Bluebell Boulevard',
            'Iris Avenue',
            'Violeta Street',
            'Zinnia Drive',
            'Carnation Road',
            'Hibiscus Boulevard',
            'Marigold Street',
            'Cosmos Drive',
            'Petunia Road',
            'Lavender Avenue',
            'Rose Street',
            'Gladiola Boulevard',
            'Peridot Avenue',
            'Topaz Street',
            'Amethyst Drive',
            'Opal Road',
            'Diamond Boulevard',
            'Sapphire Street',
            'Garnet Drive',
            'Turquoise Road',
            'Citrine Avenue',
            'Amber Street',
            'Coral Boulevard',
            'Onyx Drive',
            'Aquamarine Avenue',
            'Silver Street',
            'Gold Boulevard'
        ];

        $maleProfilePictures = [
            "sample1.jpg",
            "sample2.jpg",
            "sample3.jpg",
            "sample4.jpg",
            "sample5.jpg",
            "sample6.jpg",
            "sample7.jpg",
        ];

        $femaleProfilePictures = [
            "sample8.jpg",
            "sample9.jpg",
            "sample10.jpg",
            "sample11.jpg",
            "sample12.jpg",
            "sample13.jpg",
            "sample14.jpg",
            "sample15.jpg",
            "sample16.jpg",
            "sample17.jpg",
        ];

        $numberOfRecords = 30;
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
                    'encoder_address' => '1089 Phase3B Block10 Lot 2 Camarin Caloocan city',
                    'encoder_barangay_id' => 11,
                    'encoder_contact_no' => '+639278147238',
                    'encoder_suffix' => null, 
                    'encoder_email' => 'kristoffercabigon@gmail.com',
                    'encoder_profile_picture' => 'sample18.jpg',
                    'encoder_password' => bcrypt('Abaayos!'),
                    'encoder_verified_at' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                    'encoder_date_registered' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                ]);
            } else {
                $isMale = rand(0, 1) == 0; 
                $firstName = fake()->randomElement($isMale ? $MaleNames : $FemaleNames);

                $hasProfilePicture = rand(0, 1) == 1;

                $profile_picture = $hasProfilePicture
                    ? ($isMale
                        ? $maleProfilePictures[array_rand($maleProfilePictures)]
                        : $femaleProfilePictures[array_rand($femaleProfilePictures)])
                    : null;

                $middleName = fake()->optional(0.5)->randomElement($LastNames);
                $lastName = fake()->randomElement($LastNames);

                $suffix = $isMale ? fake()->optional(0.5)->randomElement(['Jr.', 'Sr.', 'I', 'II', 'III']) : null;

                $email = strtolower(str_replace(' ', '', $firstName)) .
                    strtolower(str_replace(' ', '', $middleName ?? '')) .
                    strtolower(str_replace(' ', '', $lastName)) .
                    ($suffix ? strtolower(str_replace(' ', '', $suffix)) : '') .
                    rand(10, 99) . '@example.com';

                $houseNumber = fake()->numberBetween(1000, 9999);
                $phase = 'Phase ' . fake()->numberBetween(1, 10);
                $block = 'Block ' . fake()->numberBetween(1, 90);
                $lot = 'Lot ' . fake()->numberBetween(1, 90);
                $barangayNo = fake()->randomElement($barangays);
                $barangayIndex = array_search($barangayNo, $barangays) + 1;
                $filipinoStreetName = fake()->randomElement($filipinoStreet);
                $encoder_address = "{$houseNumber} {$phase} {$block} {$lot} {$filipinoStreetName}, {$barangayNo}, Caloocan City";

                $encoder_contact_no = fake()->regexify('\+639[0-9]{9}');

                $baseTimestamp = strtotime('-5 years');
                static $counter = 0;
                $randomGap = rand(1, 50) * 86400;
                $timestamp = $baseTimestamp + ($counter * $randomGap);
                $date_registered = date('Y-m-d H:i:s', $timestamp); 

                $counter++;

                Encoder::create([
                    'encoder_id' => $encoderId,
                    'encoder_user_type_id' => 2,
                    'encoder_first_name' => $firstName,
                    'encoder_middle_name' => $middleName,
                    'encoder_last_name' => $lastName,
                    'encoder_address' => $encoder_address,
                    'encoder_barangay_id' => $barangayIndex,
                    'encoder_contact_no' => $encoder_contact_no,
                    'encoder_suffix' => $suffix,
                    'encoder_email' => $email,
                    'encoder_profile_picture' => $profile_picture,
                    'encoder_password' => bcrypt('password'),
                    'encoder_verified_at' => fake()->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                    'encoder_date_registered' => $date_registered, 
                ]);

            }
        }
    }
}
