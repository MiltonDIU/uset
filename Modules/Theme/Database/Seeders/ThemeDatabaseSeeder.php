<?php

namespace Modules\Theme\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Theme\app\Models\Theme;

class ThemeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Theme::updateOrCreate(
            ['slug' => 'default'],
            [
                'name' => 'Default Theme',
                'description' => 'Standard university theme.',
                'is_active' => true,
            ]
        );
    }
}
