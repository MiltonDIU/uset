<?php

namespace Modules\Academic\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Academic\app\Models\AcademicEvent;
use Modules\Academic\app\Models\AcademicSession;
use Modules\Academic\app\Models\AdmissionRequirement;
use Modules\Academic\app\Models\CareerProspect;
use Modules\Academic\app\Models\Committee;
use Modules\Academic\app\Models\CommitteeMember;
use Modules\Academic\app\Models\Course;
use Modules\Academic\app\Models\Department;
use Modules\Academic\app\Models\Faculty;
use Modules\Academic\app\Models\FacultyMember;
use Modules\Academic\app\Models\Program;
use Modules\Academic\app\Models\ProgramType;
use Modules\Academic\app\Models\ResearchInterest;
use Modules\Academic\app\Models\Tuition;
use Modules\Academic\app\Models\TuitionType;

class AcademicDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Path
        $dataPath = public_path('themes/default/assets/data/');

        // 2. Load JSON Files
        $facultyData = json_decode(File::get($dataPath.'faculty.json'), true);
        $programsData = json_decode(File::get($dataPath.'programs.json'), true);
        $tuitionData = json_decode(File::get($dataPath.'tuition_scholarships.json'), true);
        $newsData = json_decode(File::get($dataPath.'news.json'), true);

        // 3. Seed Basic Types
        $programTypes = [
            ['name' => 'Undergraduate', 'slug' => 'undergraduate', 'sort_order' => 1],
            ['name' => 'Graduate', 'slug' => 'graduate', 'sort_order' => 2],
        ];
        foreach ($programTypes as $type) {
            ProgramType::updateOrCreate(['slug' => $type['slug']], $type);
        }

        $tuitionTypes = [
            ['name' => 'National', 'slug' => 'national', 'sort_order' => 1],
            ['name' => 'International', 'slug' => 'international', 'sort_order' => 2],
        ];
        foreach ($tuitionTypes as $type) {
            TuitionType::updateOrCreate(['slug' => $type['slug']], $type);
        }

        $undergraduateId = ProgramType::where('slug', 'undergraduate')->first()->id;
        $nationalTuitionId = TuitionType::where('slug', 'national')->first()->id;

        // 4. Seed Faculties (from programs.json structure)
        $facultyMap = [];
        foreach ($programsData['faculties'] as $fData) {
            $faculty = Faculty::updateOrCreate(
                ['slug' => $fData['id']],
                [
                    'name' => $fData['name'],
                    'description' => $fData['description'] ?? null,
                    'sort_order' => 0,
                ]
            );
            $facultyMap[$fData['id']] = $faculty->id;
        }

        // 5. Seed Departments (from faculty.json)
        $deptMap = [];
        foreach ($facultyData['departments'] as $dData) {
            // Find appropriate faculty (manual mapping based on name keywords)
            $facultyId = 1; // Default
            if (Str::contains($dData['name'], ['Business', 'Admin'])) {
                $facultyId = $facultyMap['business'] ?? 1;
            } elseif (Str::contains($dData['name'], ['Computer', 'Engineering', 'Science'])) {
                $facultyId = $facultyMap['engineering'] ?? 1;
            } elseif (Str::contains($dData['name'], ['English', 'Economics', 'Liberal'])) {
                $facultyId = $facultyMap['liberal-arts'] ?? 1;
            }

            $department = Department::updateOrCreate(
                ['slug' => $dData['id']],
                [
                    'faculty_id' => $facultyId,
                    'name' => $dData['name'],
                    'code' => strtoupper(substr($dData['id'], 0, 3)),
                    'description' => $dData['name'].' at USET.',
                    'sort_order' => 0,
                ]
            );
            $deptMap[$dData['id']] = $department->id;

            // Seed Faculty Members
            foreach ($dData['faculty'] as $memberData) {
                $member = FacultyMember::updateOrCreate(
                    ['slug' => Str::slug($memberData['name'])],
                    [
                        'department_id' => $department->id,
                        'name' => $memberData['name'],
                        'designation' => $memberData['position'],
                        'email' => strtolower(str_replace(' ', '.', $memberData['name'])).'@uset.ac',
                        'is_active' => true,
                    ]
                );

                // Add real image if exists
                if (! empty($memberData['image']) && $member->getMedia('profile_pictures')->isEmpty()) {
                    $imagePath = public_path('themes/default/assets/'.$memberData['image']);
                    if (file_exists($imagePath)) {
                        $member->addMedia($imagePath)
                            ->preservingOriginal()
                            ->toMediaCollection('profile_pictures');
                    }
                }

                // Add research interests (placeholder topics based on department)
                $interests = $this->getInterestsByDept($dData['id']);
                foreach ($interests as $topic) {
                    $interest = ResearchInterest::updateOrCreate(
                        ['slug' => Str::slug($topic)],
                        ['name' => $topic, 'is_active' => true]
                    );
                    $member->researchInterests()->syncWithoutDetaching([$interest->id]);
                }
            }
        }

        // 6. Seed Programs & Related
        foreach ($programsData['faculties'] as $fData) {
            foreach ($fData['programs'] as $pData) {
                // Find department mapping
                $deptId = $deptMap[$pData['id']] ?? null;
                if (! $deptId) {
                    if (Str::contains($pData['id'], 'bba')) {
                        $deptId = $deptMap['business-admin'];
                    }
                    if (Str::contains($pData['id'], 'cse')) {
                        $deptId = $deptMap['computer-science'];
                    }
                    if (Str::contains($pData['id'], 'eee')) {
                        $deptId = $deptMap['computer-science'];
                    } // fallback
                    if (Str::contains($pData['id'], 'english')) {
                        $deptId = $deptMap['english'];
                    }
                    if (Str::contains($pData['id'], 'economics')) {
                        $deptId = $deptMap['economics'];
                    }
                }

                $program = Program::updateOrCreate(
                    ['slug' => $pData['id']],
                    [
                        'department_id' => $deptId ?? 1,
                        'program_type_id' => $undergraduateId,
                        'name' => $pData['name'],
                        'duration' => $pData['duration'],
                        'total_semester' => 8,
                        'total_credits' => $pData['credits'],
                        'overview' => $pData['description'],
                        'description' => $pData['description'],
                        'is_active' => true,
                    ]
                );

                // Seed Career Prospects
                foreach ($pData['career_paths'] as $path) {
                    CareerProspect::updateOrCreate(
                        ['program_id' => $program->id, 'title' => $path],
                        ['is_active' => true]
                    );
                }

                // Seed Admission Requirements
                AdmissionRequirement::updateOrCreate(
                    ['program_id' => $program->id, 'title' => 'Academic Requirement'],
                    ['description' => $pData['admission_requirements'], 'is_mandatory' => true]
                );

                // Seed Tuition
                Tuition::updateOrCreate(
                    ['program_id' => $program->id, 'tuition_type_id' => $nationalTuitionId],
                    [
                        'min_credit' => $pData['credits'],
                        'max_credit' => $pData['credits'],
                        'min_total_cost' => $pData['tuition_fees']['total_tuition_fee'] ?? 0,
                        'admission_fee' => $pData['tuition_fees']['admission_fee'] ?? 15000,
                        'min_tuition_fee' => $pData['tuition_fees']['total_tuition_fee'] ?? 0,
                    ]
                );

                // Seed Courses (Full Curriculum Logic)
                $this->seedFullCurriculum($program, $pData);
            }
        }

        // 7. Seed Academic Sessions & Events
        $sessions = [
            ['name' => 'Spring 2026', 'slug' => 'spring-2026', 'start_date' => '2026-01-01', 'end_date' => '2026-06-30'],
            ['name' => 'Fall 2026', 'slug' => 'fall-2026', 'start_date' => '2026-07-01', 'end_date' => '2026-12-31'],
        ];
        foreach ($sessions as $s) {
            $session = AcademicSession::updateOrCreate(['slug' => $s['slug']], $s);

            // Events from news.json
            foreach ($newsData['events'] as $eData) {
                $eventDate = str_replace('2025', '2026', $eData['startDate']);
                if (strtotime($eventDate) >= strtotime($s['start_date']) && strtotime($eventDate) <= strtotime($s['end_date'])) {
                    AcademicEvent::updateOrCreate(
                        ['title' => $eData['title'], 'academic_session_id' => $session->id],
                        [
                            'start_date' => $eventDate,
                            'end_date' => isset($eData['endDate']) ? str_replace('2025', '2026', $eData['endDate']) : null,
                            'type' => 'event',
                            'description' => $eData['description'],
                        ]
                    );
                }
            }

            // Standard academic cycle events
            if ($s['slug'] === 'spring-2026') {
                AcademicEvent::updateOrCreate(['academic_session_id' => $session->id, 'title' => 'Admission Start'], ['start_date' => '2026-01-01', 'type' => 'admission']);
                AcademicEvent::updateOrCreate(['academic_session_id' => $session->id, 'title' => 'Orientation'], ['start_date' => '2026-01-25', 'type' => 'event']);
                AcademicEvent::updateOrCreate(['academic_session_id' => $session->id, 'title' => 'Classes Begin'], ['start_date' => '2026-02-01', 'type' => 'academic']);
            }
        }

        // 8. Seed Committees
        $board = Committee::updateOrCreate(['slug' => 'board-of-trustees'], ['name' => 'Board of Trustees', 'description' => 'The highest governing body of USET.']);
        $academic = Committee::updateOrCreate(['slug' => 'academic-committee'], ['name' => 'Academic Committee', 'description' => 'Responsible for academic standards and curriculum.']);

        $trustees = [
            ['name' => 'Moazzem Hossain', 'designation' => 'Chairman'],
            ['name' => 'Dr. Md. Rashidul Hasan', 'designation' => 'Secretary'],
        ];
        foreach ($trustees as $index => $t) {
            CommitteeMember::updateOrCreate(['committee_id' => $board->id, 'name' => $t['name']], ['designation' => $t['designation'], 'sort_order' => $index]);
        }

        // 9. Seed Events from news.json
        foreach ($newsData['events'] as $eData) {
            AcademicEvent::updateOrCreate(
                ['title' => $eData['title']],
                [
                    'description' => $eData['description'],
                    'start_date' => str_replace('2025', '2026', $eData['startDate']),
                    'end_date' => str_replace('2025', '2026', $eData['endDate']),
                    'location' => $eData['location'],
                    'type' => 'event',
                    'academic_session_id' => AcademicSession::where('slug', 'spring-2026')->first()?->id ?? 1,
                ]
            );
        }
    }

    protected function getInterestsByDept(string $deptId): array
    {
        $map = [
            'computer-science' => ['Software Engineering', 'Artificial Intelligence', 'Data Science', 'Computer Networks', 'Cyber Security'],
            'business-admin' => ['Entrepreneurship', 'Marketing Strategy', 'Financial Analysis', 'Supply Chain Management', 'HR Management'],
            'english' => ['English Literature', 'Creative Writing', 'Linguistics', 'Technical Communication', 'Cultural Studies'],
            'economics' => ['Macroeconomics', 'Development Economics', 'Econometrics', 'Bangladesh Economy', 'Public Policy'],
        ];

        return $map[$deptId] ?? ['Education Technology', 'Skill Development', 'Innovation'];
    }

    protected function seedFullCurriculum(Program $program, array $pData): void
    {
        $prefix = strtoupper($pData['id']);
        $keyCourses = $pData['key_courses'] ?? [];

        // Year 1: General & Introductory (8 courses)
        $year1 = [
            ['code' => 'ENG101', 'name' => 'English Composition', 'credits' => 3, 'type' => 'ged'],
            ['code' => 'MAT101', 'name' => 'Mathematics I', 'credits' => 3, 'type' => 'ged'],
            ['code' => 'SOC101', 'name' => 'Introduction to Sociology', 'credits' => 3, 'type' => 'ged'],
            ['code' => 'PHY101', 'name' => 'Physics I', 'credits' => 3, 'type' => 'ged'],
            ['code' => $prefix.'101', 'name' => 'Introduction to the Field', 'credits' => 3, 'type' => 'core'],
            ['code' => $prefix.'102', 'name' => 'Fundamental Concepts', 'credits' => 3, 'type' => 'core'],
            ['code' => $prefix.'103', 'name' => 'Basic Principles Lab', 'credits' => 1, 'type' => 'lab'],
            ['code' => $prefix.'104', 'name' => 'Core Methodology Lab', 'credits' => 1, 'type' => 'lab'],
        ];

        foreach ($year1 as $c) {
            $uniqueCode = $c['code'].'-'.$program->slug;
            Course::updateOrCreate(['code' => $uniqueCode, 'program_id' => $program->id], [
                'slug' => Str::slug($c['name'].'-'.$uniqueCode.'-'.$program->slug),
                'name' => $c['name'],
                'credits' => $c['credits'],
                'type' => $c['type'],
                'semester_level' => 'Year 1',
                'is_active' => true,
            ]);
        }

        // Year 2: Intermediate & Core (8 courses)
        $year2Base = [
            ['code' => 'ENG201', 'name' => 'Business Communication', 'credits' => 3, 'type' => 'ged'],
            ['code' => 'MAT201', 'name' => 'Statistics', 'credits' => 3, 'type' => 'ged'],
        ];

        // Take first 2 from keyCourses if available
        $core2 = array_slice($keyCourses, 0, 2);
        $intermediateField = ['Intermediate Applications', 'Professional Skills I', 'Theoretical Frameworks', 'Research Methods'];

        $year2 = array_merge($year2Base);
        foreach ($core2 as $idx => $name) {
            $year2[] = ['code' => $prefix.'21'.($idx + 1), 'name' => $name, 'credits' => 3, 'type' => 'core'];
        }
        foreach ($intermediateField as $idx => $name) {
            if (count($year2) >= 8) {
                break;
            }
            $year2[] = ['code' => $prefix.'22'.($idx + 1), 'name' => $name, 'credits' => 3, 'type' => 'core'];
        }

        foreach ($year2 as $c) {
            $uniqueCode = $c['code'].'-'.$program->slug;
            Course::updateOrCreate(['code' => $uniqueCode, 'program_id' => $program->id], [
                'slug' => Str::slug($c['name'].'-'.$uniqueCode.'-'.$program->slug),
                'name' => $c['name'],
                'credits' => $c['credits'],
                'type' => $c['type'],
                'semester_level' => 'Year 2',
                'is_active' => true,
            ]);
        }

        // Year 3: Advanced & Electives (8 courses)
        $core3 = array_slice($keyCourses, 2, 4);
        $advancedField = ['Advanced Concepts', 'Specialized Topics I', 'Professional Skills II', 'Project I', 'Industry Integration'];

        $year3 = [];
        foreach ($core3 as $idx => $name) {
            $year3[] = ['code' => $prefix.'31'.($idx + 1), 'name' => $name, 'credits' => 3, 'type' => 'core'];
        }
        foreach ($advancedField as $idx => $name) {
            if (count($year3) >= 8) {
                break;
            }
            $year3[] = ['code' => $prefix.'32'.($idx + 1), 'name' => $name, 'credits' => 3, 'type' => 'core'];
        }

        foreach ($year3 as $c) {
            $uniqueCode = $c['code'].'-'.$program->slug;
            Course::updateOrCreate(['code' => $uniqueCode, 'program_id' => $program->id], [
                'slug' => Str::slug($c['name'].'-'.$uniqueCode.'-'.$program->slug),
                'name' => $c['name'],
                'credits' => $c['credits'],
                'type' => $c['type'],
                'semester_level' => 'Year 3',
                'is_active' => true,
            ]);
        }

        // Year 4: Specialization & Project (8 courses)
        $specialized = [
            ['code' => $prefix.'401', 'name' => 'Specialized Topics II', 'credits' => 3, 'type' => 'core'],
            ['code' => $prefix.'402', 'name' => 'Specialized Topics III', 'credits' => 3, 'type' => 'core'],
            ['code' => $prefix.'403', 'name' => 'Professional Skills III', 'credits' => 3, 'type' => 'core'],
            ['code' => $prefix.'404', 'name' => 'Technical Elective I', 'credits' => 3, 'type' => 'elective'],
            ['code' => $prefix.'405', 'name' => 'Technical Elective II', 'credits' => 3, 'type' => 'elective'],
            ['code' => $prefix.'406', 'name' => 'Internship', 'credits' => 3, 'type' => 'core'],
            ['code' => $prefix.'407', 'name' => 'Ethics and Professional Responsibility', 'credits' => 3, 'type' => 'core'],
            ['code' => $prefix.'499', 'name' => 'Capstone Project / Thesis', 'credits' => 6, 'type' => 'core'],
        ];

        foreach ($specialized as $c) {
            $uniqueCode = $c['code'].'-'.$program->slug;
            Course::updateOrCreate(['code' => $uniqueCode, 'program_id' => $program->id], [
                'slug' => Str::slug($c['name'].'-'.$uniqueCode.'-'.$program->slug),
                'name' => $c['name'],
                'credits' => $c['credits'],
                'type' => $c['type'],
                'semester_level' => 'Year 4',
                'is_active' => true,
            ]);
        }
    }
}
