<?php

namespace Modules\News\database\seeders;

use Illuminate\Database\Seeder;
use Modules\News\app\Models\NewsCategory;
use Modules\News\app\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class NewsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Research',
            'Student',
            'Achievement',
            'Academic',
            'Notice',
        ];

        $categoryModels = [];
        foreach ($categories as $catName) {
            $categoryModels[$catName] = NewsCategory::firstOrCreate([
                'name' => $catName,
                'slug' => Str::slug($catName),
                'is_active' => true,
            ]);
        }

        $newsData = [
            [
                'title' => 'USET Chairman Meets and Congratulates Newly Appointed UGC Chairman',
                'news_date' => '2026-04-09',
                'category' => 'Achievement',
                'is_featured' => true,
                'content' => "The Chairman, BoT of the University of Skill Enrichment and Technology (USET) met with and congratulated the newly appointed Chairman of the University Grants Commission (UGC), Professor Dr. Mamun Ahmed, in a cordial meeting held Thursday, April 09, 2026.\n\nDuring the meeting, Mr. Shakhawat Hossain, Chairman of the Board of Trustees (BoT), USET, who is also the Honorary Consulate of Portugal in Bangladesh, extended his heartfelt congratulations to Professor Dr. Mamun Ahmed on his new role and expressed confidence in his leadership to further strengthen higher education in the country.",
                'status' => 'published',
                'featured_image' => 'new_banner_1.jpeg',
            ],
            [
                'title' => 'USET Students Win National Skill Competition',
                'news_date' => '2025-05-24',
                'category' => 'Achievement',
                'content' => "Our talented students secured first place in the National Skill Competition, showcasing the strength of USET's practical education approach.",
                'status' => 'published',
            ],
            [
                'title' => 'Strategic Partnerships with Tech Companies',
                'news_date' => '2025-03-18',
                'category' => 'Academic',
                'content' => "USET has partnered with leading tech companies, enhancing internship and job placement opportunities for students.",
                'status' => 'published',
            ],
            [
                'title' => 'Renewable Energy Research Grant Awarded',
                'news_date' => '2025-04-05',
                'category' => 'Research',
                'content' => "The Department of Engineering secured a grant for innovative sustainable energy solutions for rural communities.",
                'status' => 'published',
            ],
            [
                'title' => 'Breakthrough in Quantum Computing Research',
                'news_date' => '2025-05-20',
                'category' => 'Research',
                'content' => "USET researchers achieve a milestone in quantum computing, advancing potential applications in cryptography.",
                'status' => 'published',
            ],
            [
                'title' => 'Student-Led Startup Wins Funding',
                'news_date' => '2025-05-15',
                'category' => 'Student',
                'content' => "A USET student startup secures significant funding for their innovative app addressing local healthcare needs.",
                'status' => 'published',
            ],
            [
                'title' => 'Solar Energy Project Launched',
                'news_date' => '2025-05-10',
                'category' => 'Research',
                'content' => "USET launches a new initiative to develop affordable solar energy solutions for urban areas.",
                'status' => 'published',
            ],
        ];

        $imagePath = base_path('public/themes/default/assets/img/');

        foreach ($newsData as $item) {
            $news = News::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title' => $item['title'],
                    'news_date' => $item['news_date'],
                    'news_category_id' => $categoryModels[$item['category']]->id,
                    'is_featured' => $item['is_featured'] ?? false,
                    'content' => $item['content'],
                    'status' => $item['status'],
                    'short_description' => Str::limit(strip_tags($item['content']), 150),
                ]
            );

            // Attach featured image if provided
            if (isset($item['featured_image']) && File::exists($imagePath . $item['featured_image'])) {
                $news->clearMediaCollection('featured_image');
                $news->addMedia($imagePath . $item['featured_image'])
                    ->preservingOriginal()
                    ->toMediaCollection('featured_image');
            }
        }

        // Add gallery images to the featured news for demonstration
        $featuredNews = News::where('is_featured', true)->first();
        if ($featuredNews) {
            $galleryImages = ['10001.jpeg', '10002.jpg', '10003.jpg'];
            $featuredNews->clearMediaCollection('gallery');
            foreach ($galleryImages as $img) {
                if (File::exists($imagePath . $img)) {
                    $featuredNews->addMedia($imagePath . $img)
                        ->preservingOriginal()
                        ->toMediaCollection('gallery');
                }
            }
        }
    }
}
