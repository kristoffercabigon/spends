<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Events;
use App\Models\EventsImages;

class EventsImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Highlights = [
            'sample1.jpg',
            'sample2.jpg',
            'sample3.jpg',
            'sample4.jpg',
            'sample5.jpg',
            'sample6.jpg',
            'sample7.jpg',
            'sample8.jpg',
            'sample9.jpg',
            'sample10.jpg',
            'sample11.jpg',
            'sample12.jpg',
            'sample13.jpg',
            'sample14.jpg',
            'sample15.jpg',
            'sample16.jpg',
            'sample17.jpg',
            'sample18.jpg',
            'sample19.jpg',
            'sample20.jpg',
        ];

        $Random = [
            'sample21.jpg',
            'sample22.jpg',
            'sample23.jpg',
            'sample24.jpg',
            'sample25.jpg',
            'sample26.jpg',
            'sample27.jpg',
            'sample28.jpg',
            'sample29.jpg',
            'sample30.jpg',
            'sample31.jpg',
            'sample32.jpg',
            'sample33.jpg',
            'sample34.jpg',
            'sample35.jpg',
            'sample36.jpg',
            'sample37.jpg',
            'sample38.jpg',
            'sample39.jpg',
            'sample40.jpg',
            'sample41.jpg',
            'sample42.jpg',
            'sample43.jpg',
            'sample44.jpg',
            'sample45.jpg',
            'sample46.jpg',
            'sample47.jpg',
            'sample48.jpg',
            'sample49.jpg',
            'sample50.jpg',
            'sample51.jpg',
            'sample52.jpg',
            'sample53.jpg',
            'sample54.jpg',
            'sample55.jpg',
            'sample56.jpg',
            'sample57.jpg',
            'sample58.jpg',
            'sample59.jpg',
            'sample60.jpg',
            'sample61.jpg',
            'sample62.jpg',
            'sample63.jpg',
            'sample64.jpg',
            'sample65.jpg',
            'sample66.jpg',
            'sample67.jpg',
            'sample68.jpg',
            'sample69.jpg',
            'sample70.jpg',
            'sample71.jpg',
            'sample72.jpg',
            'sample73.jpg',
            'sample74.jpg',
            'sample75.jpg',
            'sample76.jpg',
            'sample77.jpg',
            'sample78.jpg',
            'sample79.jpg',
            'sample80.jpg',
            'sample81.jpg',
            'sample82.jpg',
            'sample83.jpg',
            'sample84.jpg',
            'sample85.jpg',
            'sample86.jpg',
            'sample87.jpg',
            'sample88.jpeg',
            'sample89.jpg',
            'sample90.jpg',
            'sample91.jpg',
            'sample92.jpg',
            'sample93.jpg',
            'sample94.jpg',
        ];

        $events = Events::all();
        $usedHighlights = [];

        foreach ($events as $event) {
            if ($event->is_featured == 1) {
                $availableHighlights = array_diff($Highlights, $usedHighlights);

                if (empty($availableHighlights)) {
                    throw new \Exception('Not enough unique highlights for featured events.');
                }

                $highlightedImage = array_shift($availableHighlights);
                $usedHighlights[] = $highlightedImage;

                EventsImages::create([
                    'event_id' => $event->id,
                    'image' => $highlightedImage,
                    'is_highlighted' => 1,
                ]);
            } else {
                $highlightedImage = $Highlights[array_rand($Highlights)];
                EventsImages::create([
                    'event_id' => $event->id,
                    'image' => $highlightedImage,
                    'is_highlighted' => 1,
                ]);
            }

            $randomImages = array_rand($Random, 4);
            foreach ($randomImages as $index) {
                EventsImages::create([
                    'event_id' => $event->id,
                    'image' => $Random[$index],
                    'is_highlighted' => 0,
                ]);
            }
        }
    }
}
