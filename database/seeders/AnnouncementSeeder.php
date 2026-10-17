<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

/**
 * Imports the announcements previously hardcoded in legacy/data/announcements.php.
 */
class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'date' => '2025-05-01',
                'text' => 'Call for invention disclosures — submit your innovative ideas to BLII-TTO for review and IP protection.',
            ],
            [
                'date' => '2025-05-15',
                'text' => 'TISC open hours: access patent databases and technology information support every weekday.',
            ],
            [
                'date' => '2025-06-01',
                'text' => 'New consultancy guidelines published — see the Downloads page for details.',
            ],
        ];

        foreach ($items as $item) {
            Announcement::updateOrCreate(
                ['date' => $item['date'], 'text' => $item['text']],
                $item + ['active' => true],
            );
        }
    }
}
