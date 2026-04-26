<?php

namespace Modules\Events\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Events\app\Models\EventCategory;
use Modules\Events\app\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EventsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Academic',
            'Community',
            'Workshop',
            'Seminar',
        ];

        $categoryModels = [];
        foreach ($categories as $catName) {
            $categoryModels[$catName] = EventCategory::firstOrCreate([
                'name' => $catName,
                'slug' => Str::slug($catName),
                'is_active' => true,
            ]);
        }

        $eventsData = [
            [
                'title' => 'AI & Machine Learning Workshop',
                'event_date' => '2025-06-10',
                'category' => 'Workshop',
                'description' => "Join our hands-on workshop to explore cutting-edge AI and machine learning techniques with industry experts.",
                'venue' => 'USET Campus, Hall A',
                'organizer' => 'Dept of Engineering',
                'banner' => '10001.jpeg',
            ],
            [
                'title' => 'Community Outreach Program',
                'event_date' => '2025-06-15',
                'category' => 'Community',
                'description' => "USET students and faculty will engage with local communities to promote STEM education and skill development.",
                'venue' => 'Narayanganj Community Center',
                'organizer' => 'Student Affairs',
                'banner' => '10002.jpg',
            ],
            [
                'title' => 'Cybersecurity Seminar',
                'event_date' => '2025-07-01',
                'category' => 'Seminar',
                'description' => "Learn about the latest trends in cybersecurity from top professionals in this interactive seminar.",
                'venue' => 'Virtual / Zoom',
                'organizer' => 'IT Department',
                'banner' => '10003.jpg',
            ],
        ];

        $imagePath = base_path('public/themes/default/assets/img/');

        foreach ($eventsData as $item) {
            $event = Event::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title' => $item['title'],
                    'event_date' => $item['event_date'],
                    'event_category_id' => $categoryModels[$item['category']]->id,
                    'description' => $item['description'],
                    'venue' => $item['venue'],
                    'organizer' => $item['organizer'],
                    'status' => 'Upcoming',
                    'is_published' => true,
                ]
            );

            // Attach banner image if provided
            if (isset($item['banner']) && File::exists($imagePath . $item['banner'])) {
                $event->clearMediaCollection('banner');
                $event->addMedia($imagePath . $item['banner'])
                    ->preservingOriginal()
                    ->toMediaCollection('banner');
            }
            
            // Also add a few images to the gallery collection
            $event->clearMediaCollection('gallery');
            $gallery = ['10004.jpg', 'AcademicCM.jpg']; // Using other available images
            foreach ($gallery as $img) {
                if (File::exists($imagePath . $img)) {
                    $event->addMedia($imagePath . $img)
                        ->preservingOriginal()
                        ->toMediaCollection('gallery');
                }
            }
        }
    }
}
