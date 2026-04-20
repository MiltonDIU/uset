<?php

namespace Database\Seeders;

use Biostate\FilamentMenuBuilder\Enums\MenuItemType;
use Biostate\FilamentMenuBuilder\Models\Menu;
use Biostate\FilamentMenuBuilder\Models\MenuItem;
use Illuminate\Database\Seeder;

class UniversityMenuSeeder extends Seeder
{
    public function run(): void
    {
        $headerMenu = Menu::updateOrCreate(
            ['slug' => 'main-menu'],
            ['name' => 'Main Navigation']
        );

        // Clear existing items completely
        MenuItem::where('menu_id', $headerMenu->id)->delete();

        $menuId = $headerMenu->id;

        $tree = [
            [
                'name'    => 'Home',
                'type'    => MenuItemType::Link->value,
                'url'     => '/',
                'target'  => '_self',
                'menu_id' => $menuId,
            ],
            [
                'name'    => 'About',
                'type'    => MenuItemType::Link->value,
                'url'     => '/about',
                'target'  => '_self',
                'menu_id' => $menuId,
            ],
            [
                'name'     => 'Academics',
                'type'     => MenuItemType::Link->value,
                'url'      => '#',
                'target'   => '_self',
                'menu_id'  => $menuId,
                'children' => [
                    [
                        'name'    => 'Academic Programs',
                        'type'    => MenuItemType::Link->value,
                        'url'     => '/academics',
                        'target'  => '_self',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name'    => 'Admission',
                        'type'    => MenuItemType::Link->value,
                        'url'     => '/admission',
                        'target'  => '_self',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name'    => 'Faculty',
                        'type'    => MenuItemType::Link->value,
                        'url'     => '/faculty',
                        'target'  => '_self',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name'    => 'Student Life',
                        'type'    => MenuItemType::Link->value,
                        'url'     => '/student-life',
                        'target'  => '_self',
                        'menu_id' => $menuId,
                    ],
                ],
            ],
            [
                'name'    => 'News & Events',
                'type'    => MenuItemType::Link->value,
                'url'     => '/news-events',
                'target'  => '_self',
                'menu_id' => $menuId,
            ],
            [
                'name'    => 'Contact',
                'type'    => MenuItemType::Link->value,
                'url'     => '/contact',
                'target'  => '_self',
                'menu_id' => $menuId,
            ],
            [
                'name'     => 'Portals',
                'type'     => MenuItemType::Link->value,
                'url'      => '#',
                'target'   => '_self',
                'menu_id'  => $menuId,
                'children' => [
                    [
                        'name'    => 'Student Portal',
                        'type'    => MenuItemType::Link->value,
                        'url'     => 'https://studentportal.uset.ac/',
                        'target'  => '_blank',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name'    => 'Academic Result',
                        'type'    => MenuItemType::Link->value,
                        'url'     => 'https://studentportal.uset.ac/academic-result',
                        'target'  => '_blank',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name'    => 'Teacher Portal',
                        'type'    => MenuItemType::Link->value,
                        'url'     => 'https://teacherportal.uset.ac/',
                        'target'  => '_blank',
                        'menu_id' => $menuId,
                    ],
                ],
            ],
        ];

        // rebuildTree handles all lft/rgt calculation internally
        MenuItem::rebuildTree($tree, false);
    }
}