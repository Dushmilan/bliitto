<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\ContactMessage;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Adds the demonstration account and sample content used by the public demo.
 *
 * Every write is keyed to an existing record so the seeder can run on each
 * container boot without creating duplicates.
 */
class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedAdministrator();
        $this->seedMessages();
        $this->seedNews();
        $this->seedAnnouncements();
    }

    private function seedAdministrator(): void
    {
        if (app()->isProduction() && ! config('bliitto.show_demo_credentials')) {
            $this->command?->warn('Skipping the demo administrator because demo credentials are disabled.');

            return;
        }

        User::updateOrCreate(
            ['email' => config('bliitto.demo_admin_email')],
            [
                'name' => config('bliitto.demo_admin_name'),
                'password' => config('bliitto.demo_admin_password'),
            ],
        );
    }

    private function seedMessages(): void
    {
        $messages = [
            [
                'name' => 'Nadeesha Perera',
                'email' => 'nadeesha.perera@example.lk',
                'message' => 'We are interested in licensing the low-cost water filtration technology developed by the Faculty of Engineering. Could we arrange a meeting with the technology transfer team?',
                'read_at' => null,
            ],
            [
                'name' => 'Ravi Fernando',
                'email' => 'ravi@example.lk',
                'message' => 'Our company would like to discuss a research collaboration on sustainable packaging. Please let us know the next steps for a consultancy agreement.',
                'read_at' => null,
            ],
            [
                'name' => 'Dr. Ishara Silva',
                'email' => 'ishara.silva@example.lk',
                'message' => 'I have developed a prototype for an agricultural sensor and would like guidance on filing a patent and preparing an invention disclosure.',
                'read_at' => now()->subDay(),
            ],
            [
                'name' => 'Malith Jayasinghe',
                'email' => 'malith@example.lk',
                'message' => 'A group of final-year students is looking for incubation support for a medical devices startup. What support does BLII-TTO provide for early-stage teams?',
                'read_at' => null,
            ],
        ];

        foreach ($messages as $message) {
            ContactMessage::firstOrCreate(
                ['email' => $message['email']],
                $message,
            );
        }
    }

    private function seedNews(): void
    {
        $items = [
            [
                'title' => 'Technology Transfer Office Joins National TISC Network',
                'date' => '2025-07-08',
                'image' => 'news-meeting.jpg',
                'description' => 'BLII-TTO now offers expanded technology information and patent search support through the national TISC network.',
                'link' => 'tisc.php',
            ],
            [
                'title' => 'First Research-Led Startup Cohort Announced',
                'date' => '2025-08-19',
                'image' => 'news-coffee.jpg',
                'description' => 'Four university spin-offs joined the new incubation programme covering business planning, prototyping and investor readiness.',
                'link' => 'services.php',
            ],
            [
                'title' => 'Patent Search Service Expanded for Researchers',
                'date' => '2025-09-30',
                'image' => 'news-training.jpg',
                'description' => 'Researchers can now request prior-art searches and freedom-to-operate reviews through a single online submission.',
                'link' => 'patent-searches.php',
            ],
        ];

        foreach ($items as $item) {
            News::updateOrCreate(
                ['title' => $item['title']],
                $item + ['published' => true],
            );
        }
    }

    private function seedAnnouncements(): void
    {
        $items = [
            [
                'date' => '2025-07-01',
                'text' => 'Invention disclosure clinics are held every Wednesday at the BLII-TTO office. No appointment is required.',
            ],
            [
                'date' => '2025-08-01',
                'text' => 'Industry partners can now book technology showcase sessions with university research teams through the contact form.',
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
