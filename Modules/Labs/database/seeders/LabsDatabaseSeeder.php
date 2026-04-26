<?php

namespace Modules\Labs\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Labs\app\Models\Lab;
use Modules\Academic\app\Models\Faculty;
use Modules\Academic\app\Models\Department;
use Illuminate\Support\Facades\File;

class LabsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labs = [
            [
                'name' => 'University Library',
                'location' => 'Main Building, 2nd Floor',
                'description' => 'Access to thousands of books, journals, and online databases with comfortable study spaces and professional support.',
                'specifications' => [
                    'Books' => '20,000+',
                    'Resources' => 'Digital Databases',
                    'Seating' => '200+',
                ],
                'owner_type' => 'Faculty',
            ],
            [
                'name' => 'Advanced Computer Lab',
                'location' => 'Engineering Wing, 3rd Floor',
                'description' => 'Equipped with the latest hardware and software for coursework in programming, design, and more.',
                'specifications' => [
                    'Hardware' => 'High-end Workstations',
                    'Software' => 'Adobe CC, MATLAB, VS Code',
                    'Internet' => 'Gigabit Fiber',
                ],
                'owner_type' => 'Department',
            ],
            [
                'name' => 'Innovation Center',
                'location' => 'Innovation Hub, Ground Floor',
                'description' => 'Resources and mentorship for student projects, startups, and interdisciplinary collaborations.',
                'specifications' => [
                    'Facilities' => 'Makerspace',
                    'Mentorship' => 'Available',
                    'Project Types' => 'Startups, IoT, Robotics',
                ],
                'owner_type' => 'Faculty',
            ],
        ];

        $imagePath = base_path('public/themes/default/assets/img/');

        foreach ($labs as $data) {
            $owner = null;
            if ($data['owner_type'] === 'Faculty') {
                $owner = Faculty::first();
            } else {
                $owner = Department::first();
            }

            $lab = Lab::updateOrCreate(
                ['name' => $data['name']],
                [
                    'location' => $data['location'],
                    'description' => $data['description'],
                    'specifications' => $data['specifications'],
                    'is_active' => true,
                    'labbable_type' => $owner ? get_class($owner) : null,
                    'labbable_id' => $owner ? $owner->id : null,
                ]
            );

            // Add a generic campus image if specific one is not in data
            if (File::exists($imagePath . 'campus r.jpg')) {
                $lab->clearMediaCollection('gallery');
                $lab->addMedia($imagePath . 'campus r.jpg')
                    ->preservingOriginal()
                    ->toMediaCollection('gallery');
            }
        }
    }
}
