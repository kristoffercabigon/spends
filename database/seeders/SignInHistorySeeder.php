<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Seniors;
use App\Models\Encoder;
use App\Models\Admin;
use Carbon\Carbon;

class SignInHistorySeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            'Successful' => 60,
            'Failed' => 35,
            'Throttled' => 5
        ];

        $statusPool = $this->generateStatusPool($statuses);

        $userTypes = $this->getRandomUserTypes();

        $records = [];
        foreach ($userTypes as $userTypeId) {
            $modelClass = match ($userTypeId) {
                1 => Seniors::class,
                2 => Encoder::class,
                3 => Admin::class,
                default => null
            };

            if ($modelClass) {
                $emails = $modelClass::pluck($this->getEmailColumnByUserTypeId($userTypeId))->all();
                shuffle($emails);

                foreach ($emails as $email) {
                    $loginCount = rand(1, 5);
                    for ($i = 0; $i < $loginCount; $i++) {
                        $records[] = [
                            'email' => $email,
                            'user_type_id' => $userTypeId,
                            'status' => $statusPool[array_rand($statusPool)],
                            'created_at' => $this->generateRandomDate($userTypeId),
                        ];
                    }
                }
            }
        }

        for ($i = 0; $i < 100; $i++) {
            $records[] = [
                'email' => $this->generateRandomEmail(),
                'user_type_id' => null,
                'status' => "Failed",
                'created_at' => $this->generateRandomDate(),
            ];
        }

        shuffle($records);

        DB::table('user_login_attempts')->insert($records);
    }

    private function getEmailColumnByUserTypeId(int $userTypeId): string
    {
        return match ($userTypeId) {
            1 => 'email',
            2 => 'encoder_email',
            3 => 'admin_email',
        };
    }

    private function generateStatusPool(array $distribution): array
    {
        $pool = [];
        foreach ($distribution as $status => $percentage) {
            $pool = array_merge($pool, array_fill(0, $percentage, $status));
        }
        return $pool;
    }

    private function generateRandomDate(int $userTypeId = null): string
    {
        $startDate = Carbon::now()->subYears(4);
        $endDate = Carbon::now();

        $randomDate = Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp));

        if ($userTypeId !== null && in_array($userTypeId, [2, 3])) {
            $randomTime = rand(8 * 60 * 60, 17 * 60 * 60);
            $randomDate->setTimeFromTimeString(date('H:i:s', $randomTime));
        }

        return $randomDate->toDateTimeString();
    }

    private function getRandomUserTypes(): array
    {
        $userTypes = [1, 2, 3];
        $randomUserTypes = [];

        for ($i = 0; $i < 10; $i++) {
            $randomUserTypes[] = $userTypes[array_rand($userTypes)];
        }

        shuffle($randomUserTypes);

        return $randomUserTypes;
    }

    private function generateRandomEmail(): string
    {
        $names = [
            'alex',
            'jordan',
            'casey',
            'taylor',
            'morgan',
            'jamie',
            'reese',
            'ryan',
            'pat',
            'charlie',
            'sam',
            'drew',
            'kyle',
            'jules',
            'dana',
            'quinn',
            'lee',
            'blake',
            'chris',
            'jess',
            'bailey',
            'logan',
            'ashley',
            'kelsey',
            'skyler',
            'phoenix',
            'avery',
            'carter',
            'dakota',
            'finley',
            'harper',
            'jaden',
            'kendall',
            'micah',
            'peyton',
            'river',
            'sasha',
            'spencer',
            'remy',
            'rory',
            'tristan',
            'devin',
            'colby',
            'ellison',
            'kendrick',
            'parker',
            'linden',
            'marley',
            'adrian',
            'ariel',
            'blaine',
            'cassidy',
            'cameron',
            'darian',
            'emory',
            'ellis',
            'frankie',
            'hollis',
            'jamison',
            'jody',
            'kasey',
            'lane',
            'luca',
            'malone',
            'mckenzie',
            'nolan',
            'oakley',
            'payton',
            'quincy',
            'reagan',
            'shay',
            'tatum',
            'tyler',
            'wade',
            'zane',
            'abram',
            'brody',
            'charlotte',
            'dalton',
            'emma',
            'finn',
            'georgia',
            'hannah',
            'isaiah',
            'julian',
            'kai',
            'lorelei',
            'maddox',
            'nico',
            'orion',
            'paisley',
            'quinn',
            'robbie',
            'stella',
            'terrence',
            'ulysses',
            'victor',
            'wyatt',
            'xander',
            'zara',
            'amelia',
            'brady',
            'claire',
            'dean',
            'everett',
            'felix',
            'griffin',
            'hazel',
            'ivy',
            'jace',
            'keegan',
            'lila',
            'milo',
            'noah',
            'opal',
            'paige',
            'quintin',
            'ryder',
            'sienna',
            'toby',
            'ursula',
            'valerie',
            'willow',
            'xenia',
            'yasmine',
            'zeke',
            'august',
            'blair',
            'corbin',
            'dallas',
            'ellie',
            'freddie',
            'gwen',
            'harley',
            'indigo',
            'jasper',
            'knox',
            'larkin',
            'maverick',
            'nova',
            'otto',
            'penelope',
            'quinton',
            'reid',
            'sylvie',
            'theo',
            'ulyana',
            'vivian',
            'winston',
            'xavier',
            'yara',
            'zion',
            'aaron',
            'abbey',
            'abigail',
            'adam',
            'adeline',
            'adrienne',
            'alan',
            'alba',
            'alec',
            'alexa',
            'alexandra',
            'alfred',
            'alice',
            'alicia',
            'alison',
            'allen',
            'alma',
            'alyssa',
            'amanda',
            'amber',
            'amelie',
            'amos',
            'amy',
            'ana',
            'anderson',
            'andrea',
            'angel',
            'angela',
            'angelica',
        ];

        $domains = ['gmail.com', 'yahoo.com', 'outlook.com'];

        return strtolower($names[array_rand($names)]) . rand(100, 999) . '@' . $domains[array_rand($domains)];
    }
}
