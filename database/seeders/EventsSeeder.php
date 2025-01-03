<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $data = include __DIR__ . '/EventsData.php';

        $barangays = $data['barangays'];
        $eventTitles = $data['eventTitles'];
        $descriptions = $data['descriptions'];

        $eventsVideo = [
            'sample1.mp4',
            'sample2.mp4',
            'sample3.mp4'
        ];

        $totalEvents = count($eventTitles);
        $featuredIndices = $faker->randomElements(range(0, $totalEvents - 1), 10);

        foreach ($eventTitles as $index => $title) {
            preg_match('/Barangay (\d{3}(-[A-F])?)/', $title, $matches);

            $barangay_id = null;
            if (!empty($matches)) {
                $barangayNumber = $matches[1];
                $barangay_id = array_search("Barangay $barangayNumber", $barangays) + 1;
            } else {
                $barangay_id = $faker->numberBetween(1, count($barangays));
            }

            $event_user_type_id = $faker->numberBetween(2, 3);
            $event_encoder_id = null;
            $event_admin_id = null;

            if ($event_user_type_id === 2) {
                $event_encoder_id = $faker->numberBetween(1, 30);
            } elseif ($event_user_type_id === 3) {
                $event_admin_id = 1;
            }

            $description = $descriptions[$index];

            $randomDate = $faker->dateTimeBetween('-2 years', 'now');
            $randomHour = $faker->numberBetween(8, 16);
            $randomMinute = $faker->numberBetween(0, 59);
            $eventDate = $randomDate->setTime($randomHour, $randomMinute, 0);

            $is_featured = in_array($index, $featuredIndices) ? 1 : 0;

            $video = $faker->boolean(70) ? $faker->randomElement($eventsVideo) : null;

            DB::table('events_list')->insert([
                'title' => $title,
                'description' => $description,
                'event_date' => $eventDate,
                'video' => $video,
                'is_featured' => $is_featured,
                'barangay_id' => $barangay_id,
                'event_user_type_id' => $event_user_type_id,
                'event_encoder_id' => $event_encoder_id,
                'event_admin_id' => $event_admin_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
