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
        $this->seedMainMenu();
        $this->seedQuickLinks();
        $this->seedImportantLinks();
        $this->seedFooterBottomLinks();
    }

    protected function seedMainMenu(): void
    {
        $headerMenu = Menu::updateOrCreate(
            ['slug' => 'main-menu'],
            ['name' => 'Main Navigation']
        );

        MenuItem::where('menu_id', $headerMenu->id)->delete();

        $menuId = $headerMenu->id;

        $tree = [
            [
                'name' => 'Home',
                'type' => MenuItemType::Link->value,
                'url' => '/',
                'target' => '_self',
                'menu_id' => $menuId,
            ],
            [
                'name' => 'About',
                'type' => MenuItemType::Link->value,
                'url' => '/about',
                'target' => '_self',
                'menu_id' => $menuId,
            ],
            [
                'name' => 'Academics',
                'type' => MenuItemType::Link->value,
                'url' => '#',
                'target' => '_self',
                'menu_id' => $menuId,
                'children' => [
                    [
                        'name' => 'Academic Programs',
                        'type' => MenuItemType::Link->value,
                        'url' => '/academics',
                        'target' => '_self',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name' => 'Admission',
                        'type' => MenuItemType::Link->value,
                        'url' => '/admission',
                        'target' => '_self',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name' => 'Faculty',
                        'type' => MenuItemType::Link->value,
                        'url' => '/faculty',
                        'target' => '_self',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name' => 'Student Life',
                        'type' => MenuItemType::Link->value,
                        'url' => '/student-life',
                        'target' => '_self',
                        'menu_id' => $menuId,
                    ],
                ],
            ],
            [
                'name' => 'News & Events',
                'type' => MenuItemType::Link->value,
                'url' => '/news-events',
                'target' => '_self',
                'menu_id' => $menuId,
            ],
            [
                'name' => 'Contact',
                'type' => MenuItemType::Link->value,
                'url' => '/contact',
                'target' => '_self',
                'menu_id' => $menuId,
            ],
            [
                'name' => 'Portals',
                'type' => MenuItemType::Link->value,
                'url' => '#',
                'target' => '_self',
                'menu_id' => $menuId,
                'children' => [
                    [
                        'name' => 'Student Portal',
                        'type' => MenuItemType::Link->value,
                        'url' => 'https://studentportal.uset.ac/',
                        'target' => '_blank',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name' => 'Academic Result',
                        'type' => MenuItemType::Link->value,
                        'url' => 'https://studentportal.uset.ac/academic-result',
                        'target' => '_blank',
                        'menu_id' => $menuId,
                    ],
                    [
                        'name' => 'Teacher Portal',
                        'type' => MenuItemType::Link->value,
                        'url' => 'https://teacherportal.uset.ac/',
                        'target' => '_blank',
                        'menu_id' => $menuId,
                    ],
                ],
            ],
        ];

        MenuItem::rebuildTree($tree, false);
    }

    protected function seedQuickLinks(): void
    {
        $menu = Menu::updateOrCreate(
            ['slug' => 'quick-links'],
            ['name' => 'Quick Links']
        );

        MenuItem::where('menu_id', $menu->id)->delete();

        $tree = [
            ['name' => 'About Us', 'url' => '/about', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Programs', 'url' => '/academics', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Admission', 'url' => '/admission', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Faculty', 'url' => '/faculty', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Student Life', 'url' => '/student-life', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'News & Events', 'url' => '/news-events', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
        ];

        MenuItem::rebuildTree($tree, false);
    }

    protected function seedImportantLinks(): void
    {
        $menu = Menu::updateOrCreate(
            ['slug' => 'important-links'],
            ['name' => 'Important Links']
        );

        MenuItem::where('menu_id', $menu->id)->delete();

        $tree = [
            ['name' => 'Mission & Vision', 'url' => '/about#mission-vision', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Academic Calendar', 'url' => '/academic-calendar', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Campus Facilities', 'url' => '/facilities', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Scholarships', 'url' => '/scholarships', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Tuition & Fees', 'url' => '/tuition-fees', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Student Portal', 'url' => 'https://studentportal.uset.ac/', 'type' => MenuItemType::Link->value, 'target' => '_blank', 'menu_id' => $menu->id],
        ];

        MenuItem::rebuildTree($tree, false);
    }

    protected function seedFooterBottomLinks(): void
    {
        $menu = Menu::updateOrCreate(
            ['slug' => 'footer-bottom'],
            ['name' => 'Footer Bottom']
        );

        MenuItem::where('menu_id', $menu->id)->delete();

        $tree = [
            ['name' => 'Privacy Policy', 'url' => '/privacy-policy', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Terms of Use', 'url' => '/terms-of-use', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
            ['name' => 'Sitemap', 'url' => '/sitemap', 'type' => MenuItemType::Link->value, 'target' => '_self', 'menu_id' => $menu->id],
        ];

        MenuItem::rebuildTree($tree, false);
    }
}
