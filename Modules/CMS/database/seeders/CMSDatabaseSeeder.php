<?php

namespace Modules\CMS\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\CMS\app\Models\Category;
use Modules\CMS\app\Models\Page;
use Modules\CMS\app\Models\Post;

class CMSDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedHomePage();
        $this->seedAboutPage();
        $this->seedNews();
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
                        'data' => [
                            'layout' => '12',
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'slides' => [
                                            [
                                                'image' => 'hero/new_banner_1.jpeg',
                                                'heading' => 'USET Chairman Meets and Congratulates Newly Appointed UGC Chairman',
                                                'subheading' => 'Join our vibrant community of learners and innovators',
                                                'primary_button_url' => '/student-life.html',
                                                'primary_button_text' => 'Campus Life',
                                                'secondary_button_url' => '/admission.html',
                                                'secondary_button_text' => 'Join Us',
                                            ],
                                            [
                                                'image' => 'hero/AcademicCM.jpg',
                                                'heading' => '1st Academic Council Meeting of USET',
                                                'subheading' => 'The first Academic Council Meeting of the University marked a significant milestone.',
                                                'primary_button_url' => '/AcademicCouncil.html',
                                                'primary_button_text' => 'Learn More',
                                            ],
                                            [
                                                'image' => 'hero/10001.jpeg',
                                                'heading' => 'University of Skill Enrichment & Technology',
                                                'subheading' => 'Bangladesh\'s First Skill-Based University',
                                                'primary_button_url' => '/admission.html',
                                                'primary_button_text' => 'Apply Now',
                                                'secondary_button_url' => '/academics.html',
                                                'secondary_button_text' => 'Explore Programs',
                                            ],
                                        ],
                                    ],
                                    'type' => 'hero_slider',
                                ],
                            ],
                            'is_full_width' => true,
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-white',
                        ],
                        'type' => 'layout_section',
                    ],
                    [
                        'data' => [
                            'layout' => '12',
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'badge' => 'Why USET?',
                                        'items' => [
                                            [
                                                'icon' => 'academic-cap',
                                                'title' => 'First Skill-Based University in Bangladesh',
                                                'description' => 'Pioneering approach to practical, skill-enrichment education with focus on workforce-ready graduates',
                                            ],
                                            [
                                                'icon' => 'map',
                                                'title' => 'Serving Disadvantaged Areas',
                                                'description' => 'Bringing higher education opportunities to rural and underserved areas with a commitment to educational access',
                                            ],
                                            [
                                                'icon' => 'briefcase',
                                                'title' => 'Industry-Relevant Education',
                                                'description' => 'Practical curriculum designed for employability following the dual technical education system of EU models',
                                            ],
                                            [
                                                'icon' => 'flag',
                                                'title' => 'Supporting National Development Goals',
                                                'description' => 'Addressing key challenges in science & technology, contributing to Bangladesh\'s journey to developed nation status by 2041',
                                            ],
                                            [
                                                'icon' => 'globe-alt',
                                                'title' => 'International Standards with Local Relevance',
                                                'description' => 'International curricula adapted for Bangladesh, focusing on 21st-century skill development',
                                            ],
                                        ],
                                        'title' => 'Bangladesh\'s First Skill-Based University',
                                        'button_url' => '/about',
                                        'button_text' => 'Learn More About USET',
                                        'description' => 'USET offers a unique approach to higher education in Bangladesh, focusing on practical skills and industry relevance. Discover what sets us apart.',
                                    ],
                                    'type' => 'why_choose',
                                ],
                            ],
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-white',
                        ],
                        'type' => 'layout_section',
                    ],
                    [
                        'data' => [
                            'layout' => '12',
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'badge' => 'Our Programs',
                                        'title' => 'Featured Academic Programs',
                                        'button_url' => '/academics',
                                        'button_text' => 'Explore All Programs',
                                        'description' => 'Discover our industry-relevant academic programs designed to prepare you for professional success.',
                                    ],
                                    'type' => 'featured_programs',
                                ],
                            ],
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-light',
                        ],
                        'type' => 'layout_section',
                    ],
                    [
                        'data' => [
                            'layout' => '12',
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'items' => [
                                            [
                                                'label' => 'Established',
                                                'value' => '2020',
                                            ],
                                            [
                                                'label' => 'Students',
                                                'value' => '1000+',
                                            ],
                                            [
                                                'label' => 'Faculty Members',
                                                'value' => '50+',
                                            ],
                                            [
                                                'label' => 'Academic Departments',
                                                'value' => '4',
                                            ],
                                        ],
                                        'title' => 'USET By The Numbers',
                                        'subtitle' => 'Our growth and impact in numbers',
                                    ],
                                    'type' => 'statistics',
                                ],
                            ],
                            'is_full_width' => true,
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-primary-700',
                        ],
                        'type' => 'layout_section',
                    ],
                    [
                        'data' => [
                            'layout' => '12',
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'badge' => 'Stay Updated',
                                        'title' => 'Latest News & Events',
                                        'description' => 'Stay connected with the latest happenings and upcoming events at USET',
                                    ],
                                    'type' => 'news_events',
                                ],
                            ],
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-white',
                        ],
                        'type' => 'layout_section',
                    ],
                    [
                        'data' => [
                            'layout' => '12',
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'badge' => 'Join USET',
                                        'title' => 'Ready to Start Your Educational Journey?',
                                        'description' => 'Join USET and gain the practical skills and knowledge needed for professional success. Take the first step towards your future today.',
                                        'primary_button_url' => '/admission',
                                        'primary_button_text' => 'Apply Now',
                                        'secondary_button_url' => '/contact',
                                        'secondary_button_text' => 'Contact Us',
                                    ],
                                    'type' => 'cta',
                                ],
                            ],
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-white',
                        ],
                        'type' => 'layout_section',
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
                        'data' => [
                            'layout' => 12,
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'title' => 'About USET',
                                        'description' => 'Bangladesh\'s first skill-based university dedicated to practical education and industry-relevant training.',
                                        'background_image' => null,
                                        'show_breadcrumbs' => false,
                                    ],
                                    'type' => 'page_hero',
                                ],
                            ],
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-white',
                        ],
                        'type' => 'layout_section',
                    ],
                    [
                        'data' => [
                            'layout' => 12,
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'tabs' => [
                                            [
                                                'type' => 'mission_vision',
                                                'title' => 'Mission & Vission',
                                                'vision_title' => 'Our Vision',
                                                'mission_title' => 'Our Mission',
                                                'vision_content' => 'To transform the country into a skilled and smart nation by empowering youth with future-ready skills, innovation, and technology-driven education for national progress and global competitiveness',
                                                'mission_content' => " The University of Skill Enrichment and Technology (USET) is committed to transforming Bangladesh’s youth into skilled, innovative, and technology-driven professionals by providing practical, industry-oriented education. Our mission is to bridge the gap between academia and employment and ensure inclusive access to quality higher education for all.\n\nThrough hands-on learning, entrepreneurship, research, and global collaboration, USET aims to empower individuals to drive sustainable development and lead with purpose in a rapidly evolving world. ",
                                            ],
                                            [
                                                'type' => 'timeline',
                                                'title' => 'Hour History',
                                                'timeline_items' => [
                                                    [
                                                        'icon' => 'fas fa-lightbulb',
                                                        'year' => '2018',
                                                        'title' => 'Conceptualization',
                                                        'description' => " The idea for Bangladesh's first skill-based university was conceived by a group of educators and industry leaders concerned about the gap between traditional education and workplace requirements. ",
                                                    ],
                                                    [
                                                        'icon' => 'fas fa-lightbulb',
                                                        'year' => '2019',
                                                        'title' => 'Planning & Approvals',
                                                        'description' => "The founding team developed the university's curriculum framework based on international polytechnic models and secured approvals from the Bangladesh University Grants Commission. ",
                                                    ],
                                                    [
                                                        'icon' => 'fas fa-lightbulb',
                                                        'year' => '2020',
                                                        'title' => 'Foundation & Launch',
                                                        'description' => 'USET was officially established with its first campus in Narayanganj, offering four initial programs designed with direct input from industry partners. The first batch of students was admitted in Fall 2020. ',
                                                    ],
                                                    [
                                                        'icon' => 'fas fa-lightbulb',
                                                        'year' => 'Present',
                                                        'title' => 'Growth & Recognition',
                                                        'description' => ' Today, USET continues to expand its program offerings, establish new industry partnerships, and gain recognition for its innovative approach to higher education in Bangladesh. ',
                                                    ],
                                                ],
                                            ],
                                            [
                                                'type' => 'facilities',
                                                'title' => 'Facilities',
                                                'facility_items' => [
                                                    [
                                                        'icon' => 'fas fa-laptop-code',
                                                        'title' => 'Modern Labs',
                                                        'description' => ' State-of-the-art computer and engineering laboratories equipped with the latest technology and industry-standard tools. ',
                                                    ],
                                                    [
                                                        'icon' => 'fas fa-book-reader',
                                                        'title' => 'Digital Library',
                                                        'description' => ' Comprehensive digital library with access to international journals, e-books, and research resources. ',
                                                    ],
                                                    [
                                                        'icon' => 'fas fa-users',
                                                        'title' => 'Collaboration Spaces',
                                                        'description' => ' Modern spaces designed for group work, industry collaboration, and innovative project development. ',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'type' => 'tabs_component',
                                ],
                            ],
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-white',
                        ],
                        'type' => 'layout_section',
                    ],
                    [
                        'data' => [
                            'layout' => 12,
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'badge' => 'Our Team',
                                        'title' => 'Our Leadership',
                                        'members' => [
                                            [
                                                'link' => null,
                                                'name' => 'Mr. Shakhawat Hossain',
                                                'role' => 'Chairman, Board of Trustees',
                                                'image' => 'teams/01KQ74KRJZ9XX6CZAEZ8MJR6WN.jpeg',
                                                'twitter_url' => null,
                                                'linkedin_url' => null,
                                            ],
                                            [
                                                'link' => null,
                                                'name' => 'Professor Dr. Engr. A. K. M. Fazlul Haque',
                                                'role' => 'VIce Chancellor (Designate)',
                                                'image' => 'teams/01KQ74KRK2TEJDCTWZM073A63S.jpg',
                                                'twitter_url' => null,
                                                'linkedin_url' => null,
                                            ],
                                            [
                                                'link' => null,
                                                'name' => 'Mr. Sultan Mahmud',
                                                'role' => 'Treasurer',
                                                'image' => 'teams/01KQ74KRK37B161W50D7K3E0MX.jpeg',
                                                'twitter_url' => null,
                                                'linkedin_url' => null,
                                            ],
                                        ],
                                        'subtitle' => 'Meet the visionaries shaping the future of skill-based education in Bangladesh',
                                    ],
                                    'type' => 'teams',
                                ],
                            ],
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-white',
                        ],
                        'type' => 'layout_section',
                    ],
                    [
                        'data' => [
                            'layout' => 12,
                            'padding_y' => 'py-0',
                            'col1_content' => [
                                [
                                    'data' => [
                                        'badge' => 'Visit Us',
                                        'email' => 'info@uset.ac',
                                        'phone' => '+8801733-360664',
                                        'title' => 'Our Location',
                                        'timing' => 'Friday - Saturday. 9.00 AM to 9.00 PM',
                                        'address' => '672, Kazi Bari Bus Stand, Bhuigar, Fatullah, Narayanganj-1421',
                                        'subtitle' => 'Our campus is strategically located in Narayanganj, providing easy access from Dhaka and surrounding areas',
                                        'google_maps_url' => 'https://maps.app.goo.gl/QtqvqNPbiEFRqGY36',
                                        'contact_page_link' => '/contact',
                                        'google_maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3653.8722752740264!2d90.48268259999999!3d23.680525199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b7ebf3764ead%3A0x7538b8f41cd19c5b!2sUniversity%20of%20Skill%20Enrichment%20and%20Technology%20(USET)!5e0!3m2!1sen!2sbd!4v1777289290704!5m2!1sen!2sbd',
                                    ],
                                    'type' => 'visit_us',
                                ],
                            ],
                            'container_type' => 'no-wrapper',
                            'background_color' => 'bg-white',
                        ],
                        'type' => 'layout_section',
                    ],
                ],
            ]
        );
    }

    protected function seedNews(): void
    {
        $dataPath = public_path('themes/default/assets/data/');
        $newsData = json_decode(File::get($dataPath.'news.json'), true);

        foreach ($newsData['news'] as $nData) {
            $category = Category::updateOrCreate(
                ['slug' => Str::slug($nData['category'])],
                ['name' => $nData['category']]
            );

            Post::updateOrCreate(
                ['slug' => $nData['id']],
                [
                    'category_id' => $category->id,
                    'title' => $nData['title'],
                    'excerpt' => $nData['excerpt'],
                    'content' => $nData['content'],
                    'is_published' => true,
                    'published_at' => Carbon::parse(str_replace('2025', '2026', $nData['date'])),
                ]
            );
        }
    }
}
