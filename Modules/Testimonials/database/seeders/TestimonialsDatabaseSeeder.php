<?php

namespace Modules\Testimonials\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Testimonials\app\Models\Testimonial;
use Modules\Academic\app\Models\Program;
use Illuminate\Support\Facades\File;

class TestimonialsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Rakib Ahmed',
                'designation' => 'Computer Science, Year 3',
                'quote' => 'USET’s innovative curriculum and supportive community helped me excel in my tech career.',
                'image' => 's1.jpg',
                'program_name' => 'Computer Science',
            ],
            [
                'name' => 'Mehedi Hasan',
                'designation' => 'Engineering, Year 2',
                'quote' => 'The faculty’s mentorship and hands-on projects prepared me for real-world challenges.',
                'image' => 's2.jpg',
                'program_name' => 'Engineering',
            ],
            [
                'name' => 'Tanvir Hossain',
                'designation' => 'Data Science, Year 4',
                'quote' => 'USET’s cutting-edge resources made my journey in data science truly rewarding.',
                'image' => 's3.png',
                'program_name' => 'Data Science',
            ],
            [
                'name' => 'Nafisa Rahman',
                'designation' => 'Software Engineering, Year 3',
                'quote' => 'The collaborative environment at USET fueled my passion for software development.',
                'image' => 's4.jpg',
                'program_name' => 'Software Engineering',
            ],
        ];

        $imagePath = base_path('public/themes/default/assets/img/');

        foreach ($testimonials as $data) {
            $program = Program::where('name', 'like', '%' . $data['program_name'] . '%')->first();

            $testimonial = Testimonial::updateOrCreate(
                ['name' => $data['name']],
                [
                    'designation' => $data['designation'],
                    'quote' => $data['quote'],
                    'is_active' => true,
                    'is_featured_on_home' => true,
                    'testimonialable_type' => $program ? Program::class : null,
                    'testimonialable_id' => $program ? $program->id : null,
                ]
            );

            if (File::exists($imagePath . $data['image'])) {
                $testimonial->clearMediaCollection('avatar');
                $testimonial->addMedia($imagePath . $data['image'])
                    ->preservingOriginal()
                    ->toMediaCollection('avatar');
            }
        }
    }
}
