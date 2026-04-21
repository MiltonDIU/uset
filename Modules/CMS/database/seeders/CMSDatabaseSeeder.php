<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CMS\app\Models\Page;

class CMSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homePageContent = [
            [
                'type' => 'hero_slider',
                'data' => [
                    'slides' => [
                        [
                            'image' => 'hero/new_banner_1.jpeg',
                            'heading' => 'USET Chairman Meets and Congratulates Newly Appointed UGC Chairman',
                            'subheading' => 'Join our vibrant community of learners and innovators',
                            'primary_button_text' => 'Campus Life',
                            'primary_button_url' => '/student-life.html',
                            'secondary_button_text' => 'Join Us',
                            'secondary_button_url' => '/admission.html',
                        ],
                        [
                            'image' => 'hero/AcademicCM.jpg',
                            'heading' => '1st Academic Council Meeting of USET',
                            'subheading' => 'The first Academic Council Meeting of the University of Science and Engineering Technology (USET) marked a significant milestone in shaping the institution\'s academic framework.',
                            'primary_button_text' => 'Learn More',
                            'primary_button_url' => '/AcademicCouncil.html',
                        ],
                        [
                            'image' => 'hero/10001.jpeg',
                            'heading' => 'University of Skill Enrichment & Technology',
                            'subheading' => 'Bangladesh\'s First Skill-Based University',
                            'primary_button_text' => 'Apply Now',
                            'primary_button_url' => '/admission.html',
                            'secondary_button_text' => 'Explore Programs',
                            'secondary_button_url' => '/academics.html',
                        ],
                        [
                            'image' => 'hero/b-004.jpeg',
                            'heading' => 'Innovation & Research',
                            'subheading' => 'Pioneering the future through cutting-edge research',
                            'primary_button_text' => 'Research Centers',
                            'primary_button_url' => '/research.html',
                            'secondary_button_text' => 'Learn More',
                            'secondary_button_url' => '/academics.html',
                        ],
                    ],
                ],
            ],
            [
                'type' => 'why_choose',
                'data' => [
                    'badge' => 'Why USET?',
                    'title' => 'What Makes Us Different',
                    'description' => 'USET offers a unique approach to higher education in Bangladesh, focusing on practical skills and industry relevance. Discover what sets us apart.',
                    'items' => [
                        [
                            'title' => 'First Skill-Based University in Bangladesh',
                            'description' => 'Pioneering approach to practical, skill-enrichment education with focus on workforce-ready graduates',
                            'icon' => 'academic-cap',
                        ],
                        [
                            'title' => 'Serving Disadvantaged Areas',
                            'description' => 'Bringing higher education opportunities to rural and underserved areas with a commitment to educational access',
                            'icon' => 'map',
                        ],
                        [
                            'title' => 'Industry-Relevant Education',
                            'description' => 'Practical curriculum designed for employability following the dual technical education system of EU models',
                            'icon' => 'briefcase',
                        ],
                    ],
                    'button_text' => 'Learn More About USET',
                    'button_url' => '/about.html',
                ],
            ],
            [
                'type' => 'featured_programs',
                'data' => [
                    'badge' => 'Our Programs',
                    'title' => 'Featured Academic Programs',
                    'description' => 'Discover our industry-relevant academic programs designed to prepare you for professional success in the modern workplace.',
                    'button_text' => 'Explore All Programs',
                    'button_url' => '/academics.html',
                ],
            ],
            [
                'type' => 'statistics',
                'data' => [
                    'title' => 'USET By The Numbers',
                    'subtitle' => 'Our growth and impact in numbers',
                    'items' => [
                        ['label' => 'Established', 'value' => '2020'],
                        ['label' => 'Students', 'value' => '1000'],
                        ['label' => 'Faculty Members', 'value' => '50'],
                        ['label' => 'Academic Departments', 'value' => '4'],
                    ],
                ],
            ],
            [
                'type' => 'news_events',
                'data' => [
                    'badge' => 'Stay Updated',
                    'title' => 'Latest News & Events',
                    'description' => 'Stay connected with the latest happenings and upcoming events at USET',
                ],
            ],
            [
                'type' => 'cta',
                'data' => [
                    'badge' => 'Join USET',
                    'title' => 'Ready to Start Your Educational Journey?',
                    'description' => 'Join USET and gain the practical skills and knowledge needed for professional success. Take the first step towards your future today.',
                    'primary_button_text' => 'Apply Now',
                    'primary_button_url' => '/admission.html',
                    'secondary_button_text' => 'Contact Us',
                    'secondary_button_url' => '/contact.html',
                ],
            ],
        ];

        Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home Page',
                'is_published' => true,
                'content' => $homePageContent,
            ]
        );
    }
}
