<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

/**
 * Imports the news items previously hardcoded in legacy/data/news.php.
 */
class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Innovation & Commercialization Workshop',
                'date' => '2025-01-15',
                'image' => 'news-innovation.jpg',
                'description' => 'BLII-TTO hosted a workshop on transforming university research into market-ready innovations.',
                'link' => 'about.php#vision',
            ],
            [
                'title' => 'NDA Signing with Industry Partner',
                'date' => '2025-02-02',
                'image' => 'news-nda.jpg',
                'description' => 'New non-disclosure agreement signed to enable deeper university-industry collaboration.',
                'link' => 'industry.php',
            ],
            [
                'title' => 'Entrepreneurship Training Program',
                'date' => '2025-03-10',
                'image' => 'news-training.jpg',
                'description' => 'Hands-on training for researchers on IP protection, spin-offs and business incubation.',
                'link' => 'services.php',
            ],
            [
                'title' => 'Research-Industry Meetup',
                'date' => '2025-04-22',
                'image' => 'news-meeting.jpg',
                'description' => 'Researchers and industry stakeholders met to explore licensing and consultancy opportunities.',
                'link' => 'centers.php',
            ],
        ];

        foreach ($items as $item) {
            News::updateOrCreate(
                ['title' => $item['title']],
                $item + ['published' => true],
            );
        }
    }
}
