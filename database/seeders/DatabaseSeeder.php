<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Academic\database\seeders\AcademicDatabaseSeeder;
use Modules\CMS\database\seeders\CMSDatabaseSeeder;
use Modules\Theme\database\seeders\ThemeDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UniversityMenuSeeder::class,
            AcademicDatabaseSeeder::class,
            CMSDatabaseSeeder::class,
            ThemeDatabaseSeeder::class,
        ]);
        // User::factory(10)->create();

        //        User::factory()->create([
        //            'name' => 'Test User',
        //            'email' => 'test@example.com',
        //        ]);
    }
}
