<?php

namespace Modules\CMS\database\seeders;

use Illuminate\Database\Seeder;
use Modules\CMS\app\Models\Page;

class CMSDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedHomePage();
        $this->seedAboutPage();
    }

    protected function seedHomePage(): void
    {
        Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'template' => 'home',
                'is_published' => true,
                'content' => [
                    [
                        'type' => 'layout_section',
                        'data' => [
                            'background_color' => 'bg-white',
                            'padding_y' => 'py-0',
                            'is_full_width' => true,
                            'layout' => '12',
                            'col1_content' => [
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
                                                'subheading' => 'The first Academic Council Meeting of the University of Science and Engineering Technology (USET) marked a significant milestone.',
                                                'primary_button_text' => 'Learn More',
                                                'primary_button_url' => '/AcademicCouncil.html',
                                            ],
                                            [
                                                'image' => 'hero/10001.jpeg',
                                                'heading' => 'University of Skill Enrichment & Technology',
                                                'subheading' => "Bangladesh's First Skill-Based University",
                                                'primary_button_text' => 'Apply Now',
                                                'primary_button_url' => '/admission.html',
                                                'secondary_button_text' => 'Explore Programs',
                                                'secondary_button_url' => '/academics.html',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'layout_section',
                        'data' => [
                            'background_color' => 'bg-white',
                            'padding_y' => 'py-5',
                            'layout' => '12',
                            'col1_content' => [
                                [
                                    'type' => 'why_choose',
                                    'data' => [
                                        'badge' => 'Why USET?',
                                        'title' => 'What Makes Us Different',
                                        'description' => 'USET offers a unique approach to higher education in Bangladesh, focusing on practical skills and industry relevance. Discover what sets us apart.',
                                        'items' => [
                                            ['title' => 'Industry Relevant', 'description' => 'Programs designed in collaboration with industry leaders.', 'icon' => 'briefcase'],
                                            ['title' => 'Skill Focused', 'description' => 'Emphasis on practical training and hands-on experience.', 'icon' => 'academic-cap'],
                                            ['title' => 'Global Standards', 'description' => 'Curriculum following international best practices.', 'icon' => 'globe-alt'],
                                        ],
                                        'button_text' => 'Learn More About USET',
                                        'button_url' => '/about',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'layout_section',
                        'data' => [
                            'background_color' => 'bg-light',
                            'padding_y' => 'py-5',
                            'layout' => '12',
                            'col1_content' => [
                                [
                                    'type' => 'featured_programs',
                                    'data' => [
                                        'badge' => 'Our Programs',
                                        'title' => 'Featured Academic Programs',
                                        'description' => 'Discover our industry-relevant academic programs designed to prepare you for professional success.',
                                        'button_text' => 'Explore All Programs',
                                        'button_url' => '/academics',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'layout_section',
                        'data' => [
                            'background_color' => 'bg-primary-700',
                            'padding_y' => 'py-5',
                            'is_full_width' => true,
                            'layout' => '12',
                            'col1_content' => [
                                [
                                    'type' => 'statistics',
                                    'data' => [
                                        'title' => 'USET By The Numbers',
                                        'subtitle' => 'Our growth and impact in numbers',
                                        'items' => [
                                            ['label' => 'Established', 'value' => '2020'],
                                            ['label' => 'Students', 'value' => '1000+'],
                                            ['label' => 'Faculty Members', 'value' => '50+'],
                                            ['label' => 'Academic Departments', 'value' => '4'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'layout_section',
                        'data' => [
                            'background_color' => 'bg-white',
                            'padding_y' => 'py-5',
                            'layout' => '12',
                            'col1_content' => [
                                [
                                    'type' => 'news_events',
                                    'data' => [
                                        'badge' => 'Stay Updated',
                                        'title' => 'Latest News & Events',
                                        'description' => 'Stay connected with the latest happenings and upcoming events at USET',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'layout_section',
                        'data' => [
                            'background_color' => 'bg-white',
                            'padding_y' => 'py-5',
                            'layout' => '12',
                            'col1_content' => [
                                [
                                    'type' => 'cta',
                                    'data' => [
                                        'badge' => 'Join USET',
                                        'title' => 'Ready to Start Your Educational Journey?',
                                        'description' => 'Join USET and gain the practical skills and knowledge needed for professional success. Take the first step towards your future today.',
                                        'primary_button_text' => 'Apply Now',
                                        'primary_button_url' => '/admission',
                                        'secondary_button_text' => 'Contact Us',
                                        'secondary_button_url' => '/contact',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );
    }

    protected function seedAboutPage(): void
    {
        Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Us',
                'template' => 'default',
                'is_published' => true,
                'content' => [
                    [
                        'type' => 'layout_section',
                        'data' => [
                            'background_color' => 'bg-primary-700',
                            'padding_y' => 'py-5',
                            'is_full_width' => true,
                            'layout' => '12',
                            'col1_content' => [
                                [
                                    'type' => 'rich_text',
                                    'data' => [
                                        'content' => '<div class="text-center text-white py-5"><h1>About USET</h1><p class="lead">Bangladesh\'s first skill-based university dedicated to practical education and industry-relevant training.</p></div>',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'layout_section',
                        'data' => [
                            'background_color' => 'bg-white',
                            'padding_y' => 'py-5',
                            'layout' => '6,6',
                            'col1_content' => [
                                [
                                    'type' => 'rich_text',
                                    'data' => [
                                        'content' => '<h2>Our Mission</h2><p>The University of Skill Enrichment and Technology (USET) is committed to transforming Bangladesh’s youth into skilled, innovative, and technology-driven professionals by providing practical, industry-oriented education.</p>',
                                    ],
                                ],
                            ],
                            'col2_content' => [
                                [
                                    'type' => 'rich_text',
                                    'data' => [
                                        'content' => '<h2>Our Vision</h2><p>To transform the country into a skilled and smart nation by empowering youth with future-ready skills, innovation, and technology-driven education.</p>',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'layout_section',
                        'data' => [
                            'background_color' => 'bg-light',
                            'padding_y' => 'py-5',
                            'layout' => '12',
                            'col1_content' => [
                                [
                                    'type' => 'rich_text',
                                    'data' => [
                                        'content' => '<h2 class="text-center mb-4">Our History</h2><div class="row"><div class="col-md-3"><h4>2018</h4><p>Conceptualization</p></div><div class="col-md-3"><h4>2019</h4><p>Planning & Approvals</p></div><div class="col-md-3"><h4>2020</h4><p>Foundation & Launch</p></div><div class="col-md-3"><h4>Present</h4><p>Growth & Recognition</p></div></div>',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );
    }
}
