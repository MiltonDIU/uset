<?php

namespace Database\Seeders;

use Biostate\FilamentMenuBuilder\Enums\MenuItemType;
use Biostate\FilamentMenuBuilder\Models\Menu;
use Biostate\FilamentMenuBuilder\Models\MenuItem;
use Illuminate\Database\Seeder;

class UniversityMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $headerMenu = Menu::updateOrCreate(
            ['slug' => 'main-menu'],
            ['name' => 'Main Navigation']
        );

        $this->createMenuItems($headerMenu);
    }

    private function createMenuItems(Menu $menu): void
    {
        // Primary Menu Items
        $menuItems = [
            [
                'name' => 'Home',
                'type' => MenuItemType::Link,
                'url' => '/',
                'target' => '_self',
            ],
            [
                'name' => 'About',
                'type' => MenuItemType::Link,
                'url' => '/about',
                'target' => '_self',
            ],
            [
                'name' => 'Academics',
                'type' => MenuItemType::Link,
                'url' => '#',
                'target' => '_self',
                'children' => [
                    [
                        'name' => 'Academic Programs',
                        'type' => MenuItemType::Link,
                        'url' => '/academics',
                        'target' => '_self',
                    ],
                    [
                        'name' => 'Admission',
                        'type' => MenuItemType::Link,
                        'url' => '/admission',
                        'target' => '_self',
                    ],
                    [
                        'name' => 'Faculty',
                        'type' => MenuItemType::Link,
                        'url' => '/faculty',
                        'target' => '_self',
                    ],
                    [
                        'name' => 'Student Life',
                        'type' => MenuItemType::Link,
                        'url' => '/student-life',
                        'target' => '_self',
                    ],
                ],
            ],
            [
                'name' => 'News & Events',
                'type' => MenuItemType::Link,
                'url' => '/news-events',
                'target' => '_self',
            ],
            [
                'name' => 'Contact',
                'type' => MenuItemType::Link,
                'url' => '/contact',
                'target' => '_self',
            ],
            [
                'name' => 'Portals',
                'type' => MenuItemType::Link,
                'url' => '#',
                'target' => '_self',
                'children' => [
                    [
                        'name' => 'Student Portal',
                        'type' => MenuItemType::Link,
                        'url' => 'https://studentportal.uset.ac/',
                        'target' => '_blank',
                    ],
                    [
                        'name' => 'Academic Result',
                        'type' => MenuItemType::Link,
                        'url' => 'https://studentportal.uset.ac/academic-result',
                        'target' => '_blank',
                    ],
                    [
                        'name' => 'Teacher Portal',
                        'type' => MenuItemType::Link,
                        'url' => 'https://teacherportal.uset.ac/',
                        'target' => '_blank',
                    ],
                ],
            ],
        ];

        foreach ($menuItems as $itemData) {
            $this->saveMenuItem($menu, $itemData);
        }
    }

    private function saveMenuItem(Menu $menu, array $itemData, ?MenuItem $parent = null): void
    {
        $children = $itemData['children'] ?? [];
        unset($itemData['children']);

        $itemData['menu_id'] = $menu->id;
        if ($parent) {
            $itemData['parent_id'] = $parent->id;
        }

        $menuItem = MenuItem::where('menu_id', $menu->id)
            ->where('name', $itemData['name'])
            ->first();

        if ($menuItem) {
            $menuItem->fill($itemData);
        } else {
            $menuItem = new MenuItem($itemData);
        }

        $menuItem->menu_id = $menu->id;
        $menuItem->parent_id = $parent?->id;
        $menuItem->save();

        // Refresh the node to ensure it HAS _lft and _rgt populated.
        // This is crucial for kalnoy/nestedset when using the model as a parent in the next recursive call.
        $menuItem->refresh();

        foreach ($children as $childData) {
            $this->saveMenuItem($menu, $childData, $menuItem);
        }
    }
}
