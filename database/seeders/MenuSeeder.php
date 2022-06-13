<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::updateOrCreate(['name' => 'backend-sidebar', 'description' => 'This is backend sidebar', 'deletable' => false]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id,
            'type' => 'divider',
            'parent_id' => null, 
            'order' => 1, 
            'divider_title' => 'Menus'
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 2, 
            'title' => 'Dashboard', 
            'url' => "/admin/dashboard", 
            'icon_class' => 'pe-7s-rocket'
        ]);
        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 3, 
            'title' => 'Pages', 
            'url' => "/admin/pages", 
            'icon_class' => 'pe-7s-news-paper'
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'divider', 
            'parent_id' => null, 
            'order' => 4, 
            'divider_title' => 'Access Control'
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item','parent_id' => null, 
            'order' => 5, 
            'title' => 'Roles', 
            'url' => "/admin/roles", 
            'icon_class' => 'pe-7s-check'
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 6, 
            'title' => 'Users', 
            'url' => "/admin/users", 
            'icon_class' => 'pe-7s-users'
        ]);


        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'divider', 
            'parent_id' => null, 
            'order' => 7, 
            'divider_title' => 'System'
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 8, 
            'title' => 'Menus', 
            'url' => "/admin/menus", 
            'icon_class' => 'pe-7s-menu'
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 9, 'title' => 
            'Backups', 
            'url' => "/admin/backups", 
            'icon_class' => 'pe-7s-cloud'
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 10, 
            'title' => 'Settings', 
            'url' => "/admin/settings/general", 
            'icon_class' => 'pe-7s-settings'
        ]);

        
        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'divider', 
            'parent_id' => null, 
            'order' => 11, 
            'divider_title' => 'Backend'
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 12, 
            'title' => 'Brands', 
            'icon_class' => 'pe-7s-box1',
            'url' => "/admin/brands", 
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 13, 
            'title' => 'Category', 
            'icon_class' => 'pe-7s-box2',
            'url' => "/admin/categories", 
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 14, 
            'title' => 'Sub Category', 
            'icon_class' => 'pe-7s-box2',
            'url' => "/admin/subcategories", 
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 15, 
            'title' => 'Product', 
            'icon_class' => 'pe-7s-graph2',
            'url' => "/admin/products", 
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 16, 
            'title' => 'Coupon', 
            'icon_class' => 'pe-7s-arc',
            'url' => "/admin/coupons", 
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 17, 
            'title' => 'Blog', 
            'icon_class' => 'pe-7s-note2',
            'url' => "/admin/blogs", 
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $menu->id, 
            'type' => 'item', 
            'parent_id' => null, 
            'order' => 18, 
            'title' => 'Message', 
            'icon_class' => 'pe-7s-note',
            'url' => "/admin/messages", 
        ]);
    }
}
