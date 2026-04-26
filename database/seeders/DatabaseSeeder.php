<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Academic\database\seeders\AcademicDatabaseSeeder;
use Modules\CMS\database\seeders\CMSDatabaseSeeder;
use Modules\Theme\database\seeders\ThemeDatabaseSeeder;
use Modules\News\database\seeders\NewsDatabaseSeeder;
use Modules\Events\database\seeders\EventsDatabaseSeeder;
use Modules\Testimonials\database\seeders\TestimonialsDatabaseSeeder;
use Modules\Labs\database\seeders\LabsDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
//             UniversityMenuSeeder::class,
//             AcademicDatabaseSeeder::class,
//             CMSDatabaseSeeder::class,
//             ThemeDatabaseSeeder::class,
//            NewsDatabaseSeeder::class,
//            EventsDatabaseSeeder::class,
            TestimonialsDatabaseSeeder::class,
            LabsDatabaseSeeder::class,
        ]);
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );
    }
}
