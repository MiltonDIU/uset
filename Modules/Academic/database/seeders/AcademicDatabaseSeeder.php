<?php

namespace Modules\Academic\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Academic\app\Models\Department;
use Modules\Academic\app\Models\Faculty;
use Modules\Academic\app\Models\Program;
use Modules\Academic\app\Models\ProgramType;
use Modules\Academic\app\Models\Tuition;
use Modules\Academic\app\Models\TuitionType;

class AcademicDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Program Types
        $programTypes = [
            ['name' => 'Undergraduate', 'slug' => 'undergraduate', 'sort_order' => 1],
            ['name' => 'Graduate', 'slug' => 'graduate', 'sort_order' => 2],
            ['name' => 'Diploma', 'slug' => 'diploma', 'sort_order' => 3],
            ['name' => 'Certificate', 'slug' => 'certificate', 'sort_order' => 4],
        ];

        foreach ($programTypes as $type) {
            ProgramType::updateOrCreate(['slug' => $type['slug']], $type);
        }

        // Tuition Types
        $tuitionTypes = [
            ['name' => 'National Student', 'slug' => 'national-student', 'sort_order' => 1],
            ['name' => 'International Student', 'slug' => 'international-student', 'sort_order' => 2],
        ];

        foreach ($tuitionTypes as $type) {
            TuitionType::updateOrCreate(['slug' => $type['slug']], $type);
        }

        // 1. Seed Faculties
        $faculties = [
            [
                'name' => 'Faculty of Business',
                'slug' => 'faculty-of-business',
                'description' => 'The Faculty of Business at USET offers programs that combine theoretical knowledge with practical skills needed in today\'s global business environment.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Faculty of Engineering',
                'slug' => 'faculty-of-engineering',
                'description' => 'The Faculty of Engineering at USET offers cutting-edge programs that combine theoretical knowledge with hands-on skills in emerging technical fields.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Faculty of Liberal Arts and Social Science',
                'slug' => 'faculty-of-liberal-arts-and-social-science',
                'description' => 'The Faculty of Liberal Arts and Social Science offers programs that develop critical thinking, communication, and analytical skills essential for a variety of careers.',
                'sort_order' => 3,
            ],
        ];

        foreach ($faculties as $facultyData) {
            Faculty::updateOrCreate(['slug' => $facultyData['slug']], $facultyData);
        }

        // 2. Seed Departments
        $departments = [
            // Business
            [
                'faculty_id' => Faculty::where('slug', 'faculty-of-business')->first()->id,
                'name' => 'Department of Business Administration',
                'slug' => 'department-of-business-administration',
                'code' => 'DBA',
                'sort_order' => 1,
            ],
            // Engineering
            [
                'faculty_id' => Faculty::where('slug', 'faculty-of-engineering')->first()->id,
                'name' => 'Department of Computer Science and Engineering',
                'slug' => 'department-of-computer-science-and-engineering',
                'code' => 'CSE',
                'sort_order' => 1,
            ],
            [
                'faculty_id' => Faculty::where('slug', 'faculty-of-engineering')->first()->id,
                'name' => 'Department of Electrical and Electronic Engineering',
                'slug' => 'department-of-electrical-and-electronic-engineering',
                'code' => 'EEE',
                'sort_order' => 2,
            ],
            // Liberal Arts
            [
                'faculty_id' => Faculty::where('slug', 'faculty-of-liberal-arts-and-social-science')->first()->id,
                'name' => 'Department of English',
                'slug' => 'department-of-english',
                'code' => 'ENG',
                'sort_order' => 1,
            ],
            [
                'faculty_id' => Faculty::where('slug', 'faculty-of-liberal-arts-and-social-science')->first()->id,
                'name' => 'Department of Economics',
                'slug' => 'department-of-economics',
                'code' => 'ECO',
                'sort_order' => 2,
            ],
        ];

        foreach ($departments as $deptData) {
            Department::updateOrCreate(['slug' => $deptData['slug']], $deptData);
        }

        // 3. Seed Programs & Tuitions
        $undergraduateId = ProgramType::where('slug', 'undergraduate')->first()->id;
        $nationalTuitionId = TuitionType::where('slug', 'national-student')->first()->id;

        $programs = [
            [
                'dept_slug' => 'department-of-business-administration',
                'name' => 'Bachelor of Business Administration (BBA)',
                'slug' => 'bba',
                'duration' => '4 years',
                'total_semester' => 8,
                'description' => 'Our BBA program provides students with a solid foundation in business principles with specialized practical training in key areas including management, marketing, finance, and entrepreneurship.',
                'tuition' => [
                    'min_credit' => 140,
                    'max_credit' => 140,
                    'min_total_cost' => 268000,
                    'admission_fee' => 15000,
                ],
                'facilities' => [
                    ['title' => 'Business Case Competitions', 'description' => 'Participate in industry-led competitions.'],
                    ['title' => 'Industry Internships', 'description' => 'Gain real-world experience at top firms.'],
                ],
            ],
            [
                'dept_slug' => 'department-of-computer-science-and-engineering',
                'name' => 'B.Sc in Computer Science & Engineering',
                'slug' => 'bsc-cse',
                'duration' => '4 years',
                'total_semester' => 8,
                'description' => 'Our CSE program prepares students with both theoretical foundations and practical skills in software development, computer systems, and emerging technologies like AI and data science.',
                'tuition' => [
                    'min_credit' => 154,
                    'max_credit' => 154,
                    'min_total_cost' => 347700,
                    'admission_fee' => 15000,
                ],
                'facilities' => [
                    ['title' => 'Programming Labs', 'description' => 'State-of-the-art computing facilities.'],
                    ['title' => 'AI & Data Science Hub', 'description' => 'Specialized labs for emerging tech.'],
                ],
            ],
            [
                'dept_slug' => 'department-of-electrical-and-electronic-engineering',
                'name' => 'B.Sc in Electrical and Electronic Engineering',
                'slug' => 'bsc-eee',
                'duration' => '4 years',
                'total_semester' => 8,
                'description' => 'Our EEE program equips students with theoretical foundations and practical skills in electrical systems, electronics, and emerging technologies like renewable energy and automation.',
                'tuition' => [
                    'min_credit' => 140,
                    'max_credit' => 140,
                    'min_total_cost' => 320800,
                    'admission_fee' => 15000,
                ],
                'facilities' => [
                    ['title' => 'Electrical Circuit Labs', 'description' => 'Hands-on training with advanced machinery.'],
                    ['title' => 'Renewable Energy Systems', 'description' => 'Research focused on green energy.'],
                ],
            ],
            [
                'dept_slug' => 'department-of-english',
                'name' => 'BA in English',
                'slug' => 'ba-english',
                'duration' => '4 years',
                'total_semester' => 8,
                'description' => 'Our English program provides comprehensive education in English literature, language, and communication skills with practical applications in professional settings.',
                'tuition' => [
                    'min_credit' => 140,
                    'max_credit' => 140,
                    'min_total_cost' => 241200,
                    'admission_fee' => 15000,
                ],
                'facilities' => [
                    ['title' => 'Writing Workshops', 'description' => 'Enhance creative and technical writing skills.'],
                    ['title' => 'Publication Projects', 'description' => 'Opportunities to publish in university journals.'],
                ],
            ],
            [
                'dept_slug' => 'department-of-economics',
                'name' => 'BSS in Economics',
                'slug' => 'bss-economics',
                'duration' => '4 years',
                'total_semester' => 8,
                'description' => 'Our Economics program combines theoretical foundations with practical tools for analyzing economic trends, policies, and development issues particularly relevant to Bangladesh.',
                'tuition' => [
                    'min_credit' => 140,
                    'max_credit' => 140,
                    'min_total_cost' => 243000,
                    'admission_fee' => 15000,
                ],
                'facilities' => [
                    ['title' => 'Policy Research', 'description' => 'Analyze economic trends and government policies.'],
                    ['title' => 'Statistical Analysis Labs', 'description' => 'Advanced tools for economic data analysis.'],
                ],
            ],
        ];

        foreach ($programs as $progData) {
            $dept = Department::where('slug', $progData['dept_slug'])->first();

            $program = Program::updateOrCreate(
                ['slug' => $progData['slug']],
                [
                    'department_id' => $dept->id,
                    'program_type_id' => $undergraduateId,
                    'name' => $progData['name'],
                    'duration' => $progData['duration'],
                    'total_semester' => $progData['total_semester'],
                    'description' => $progData['description'],
                    'is_active' => true,
                ]
            );

            // Seed Tuition
            Tuition::updateOrCreate(
                [
                    'program_id' => $program->id,
                    'tuition_type_id' => $nationalTuitionId,
                ],
                $progData['tuition']
            );

            // Seed Facilities (Polymorphic)
            foreach ($progData['facilities'] as $facility) {
                $program->facilities()->updateOrCreate(
                    ['title' => $facility['title']],
                    [
                        'description' => $facility['description'],
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
