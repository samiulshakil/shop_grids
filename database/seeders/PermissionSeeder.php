<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleDashboard = Module::updateOrCreate(['name'=> 'Admin Dashboard']);

        Permission::updateOrCreate([
            'module_id' => $moduleDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'admin.dashboard',
        ]);

        //Role Management
        $moduleRole = Module::updateOrCreate(['name'=> 'Role Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name' => 'Access Role',
            'slug' => 'admin.roles.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name' => 'Create Role',
            'slug' => 'admin.roles.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name' => 'Edit Role',
            'slug' => 'admin.roles.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name' => 'Delete Role',
            'slug' => 'admin.roles.destroy',
        ]);

        //User Management
        $moduleUser = Module::updateOrCreate(['name'=> 'User Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name' => 'Access User',
            'slug' => 'admin.users.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name' => 'Create User',
            'slug' => 'admin.users.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name' => 'Edit User',
            'slug' => 'admin.users.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name' => 'Delete User',
            'slug' => 'admin.users.destroy',
        ]);

        //Backup Management
        $moduleBackups = Module::updateOrCreate(['name'=> 'Backup Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleBackups->id,
            'name' => 'Access Backup',
            'slug' => 'admin.backups.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBackups->id,
            'name' => 'Create Backup',
            'slug' => 'admin.backups.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBackups->id,
            'name' => 'Download Backup',
            'slug' => 'admin.backups.download',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBackups->id,
            'name' => 'Delete Backup',
            'slug' => 'admin.backups.destroy',
        ]);

        //Page Management
        $modulePages = Module::updateOrCreate(['name'=> 'Page Management']);

        Permission::updateOrCreate([
            'module_id' => $modulePages->id,
            'name' => 'Access Page',
            'slug' => 'admin.pages.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $modulePages->id,
            'name' => 'Create Page',
            'slug' => 'admin.pages.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $modulePages->id,
            'name' => 'Edit Page',
            'slug' => 'admin.pages.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $modulePages->id,
            'name' => 'Delete Page',
            'slug' => 'admin.pages.destroy',
        ]);

         //Menu Management
         $moduleMenu = Module::updateOrCreate(['name'=> 'Menu Management']);

         Permission::updateOrCreate([
             'module_id' => $moduleMenu->id,
             'name' => 'Access Menu',
             'slug' => 'admin.menus.index',
         ]);

         Permission::updateOrCreate([
             'module_id' => $moduleMenu->id,
             'name' => 'Access Menu Builder',
             'slug' => 'admin.menus.builder',
         ]);
 
         Permission::updateOrCreate([
             'module_id' => $moduleMenu->id,
             'name' => 'Create Menu',
             'slug' => 'admin.menus.create',
         ]); 
 
         Permission::updateOrCreate([
             'module_id' => $moduleMenu->id,
             'name' => 'Edit Menu',
             'slug' => 'admin.menus.edit',
         ]);
 
         Permission::updateOrCreate([
             'module_id' => $moduleMenu->id,
             'name' => 'Delete Menu',
             'slug' => 'admin.menus.destroy',
         ]);

          //Menu Management
          $moduleSetting = Module::updateOrCreate(['name'=> 'Setting Management']);

          Permission::updateOrCreate([
            'module_id' => $moduleSetting->id,
            'name' => 'Access Setting',
            'slug' => 'admin.settings.index',
        ]);

        //Brand Management
        $moduleBrands = Module::updateOrCreate(['name'=> 'Brand Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleBrands->id,
            'name' => 'Access Brand',
            'slug' => 'admin.brands.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBrands->id,
            'name' => 'Create Brand',
            'slug' => 'admin.brands.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBrands->id,
            'name' => 'Edit Brand',
            'slug' => 'admin.brands.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBrands->id,
            'name' => 'Delete Brand',
            'slug' => 'admin.brands.destroy',
        ]);

        //Category Management
        $moduleCategories = Module::updateOrCreate(['name'=> 'Category Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleCategories->id,
            'name' => 'Access Category',
            'slug' => 'admin.categories.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleCategories->id,
            'name' => 'Create Category',
            'slug' => 'admin.categories.create',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleCategories->id,
            'name' => 'Edit Category',
            'slug' => 'admin.categories.edit',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleCategories->id,
            'name' => 'Delete Category',
            'slug' => 'admin.categories.destroy',
        ]);

                //Sub Category Management
                $moduleSubCategories = Module::updateOrCreate(['name'=> 'Sub Category Management']);

                Permission::updateOrCreate([
                    'module_id' => $moduleSubCategories->id,
                    'name' => 'Access Sub Category',
                    'slug' => 'admin.subcategories.index',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleSubCategories->id,
                    'name' => 'Create Sub Category',
                    'slug' => 'admin.subcategories.create',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleSubCategories->id,
                    'name' => 'Edit Sub Category',
                    'slug' => 'admin.subcategories.edit',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleSubCategories->id,
                    'name' => 'Delete Sub Category',
                    'slug' => 'admin.subcategories.destroy',
                ]);

                //Products Management
                $moduleProducts = Module::updateOrCreate(['name'=> 'Product Management']);

                Permission::updateOrCreate([
                    'module_id' => $moduleProducts->id,
                    'name' => 'Access Product',
                    'slug' => 'admin.products.index',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleProducts->id,
                    'name' => 'Create Product',
                    'slug' => 'admin.products.create',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleProducts->id,
                    'name' => 'Edit Product',
                    'slug' => 'admin.products.edit',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleProducts->id,
                    'name' => 'Delete Product',
                    'slug' => 'admin.products.destroy',
                ]);

                //Coupons Management
                $moduleCoupons = Module::updateOrCreate(['name'=> 'Coupon Management']);

                Permission::updateOrCreate([
                    'module_id' => $moduleCoupons->id,
                    'name' => 'Access Coupon',
                    'slug' => 'admin.coupons.index',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleCoupons->id,
                    'name' => 'Create Coupon',
                    'slug' => 'admin.coupons.create',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleCoupons->id,
                    'name' => 'Edit Coupon',
                    'slug' => 'admin.coupons.edit',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleCoupons->id,
                    'name' => 'Delete Coupon',
                    'slug' => 'admin.coupons.destroy',
                ]);

                //Website Social Media Management
                $moduleSocialMedias = Module::updateOrCreate(['name'=> 'SocialMedias Management']);

                Permission::updateOrCreate([
                    'module_id' => $moduleSocialMedias->id,
                    'name' => 'Access SocialMedia',
                    'slug' => 'admin.settings.socialmedias.index',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleSocialMedias->id,
                    'name' => 'Create SocialMedia',
                    'slug' => 'admin.settings.socialmedias.create',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleSocialMedias->id,
                    'name' => 'Edit SocialMedia',
                    'slug' => 'admin.settings.socialmedias.edit',
                ]);

                //Website Menu Management
                $moduleBanners = Module::updateOrCreate(['name'=> 'Banners Management']);

                Permission::updateOrCreate([
                    'module_id' => $moduleBanners->id,
                    'name' => 'Access Banner',
                    'slug' => 'admin.settings.banners.index',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleBanners->id,
                    'name' => 'Create Banner',
                    'slug' => 'admin.settings.banners.create',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleBanners->id,
                    'name' => 'Edit Banner',
                    'slug' => 'admin.settings.banners.edit',
                ]);

                //Blog Management
                $moduleBlogs = Module::updateOrCreate(['name'=> 'Blog Management']);

                Permission::updateOrCreate([
                    'module_id' => $moduleBlogs->id,
                    'name' => 'Access Blog',
                    'slug' => 'admin.blogs.index',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleBlogs->id,
                    'name' => 'Create Blog',
                    'slug' => 'admin.blogs.create',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleBlogs->id,
                    'name' => 'Edit Blog',
                    'slug' => 'admin.blogs.edit',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleBlogs->id,
                    'name' => 'Delete Blog',
                    'slug' => 'admin.blogs.destroy',
                ]);

                //Division Management
                $moduleDivisions = Module::updateOrCreate(['name'=> 'Division Management']);

                Permission::updateOrCreate([
                    'module_id' => $moduleDivisions->id,
                    'name' => 'Access Division',
                    'slug' => 'admin.divisions.index',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleDivisions->id,
                    'name' => 'Create Division',
                    'slug' => 'admin.divisions.create',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleDivisions->id,
                    'name' => 'Edit Division',
                    'slug' => 'admin.divisions.edit',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleDivisions->id,
                    'name' => 'Delete Division',
                    'slug' => 'admin.divisions.destroy',
                ]);

                //Zila Management
                $moduleZilas = Module::updateOrCreate(['name'=> 'Zila Management']);

                Permission::updateOrCreate([
                    'module_id' => $moduleZilas->id,
                    'name' => 'Access Zila',
                    'slug' => 'admin.zilas.index',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleZilas->id,
                    'name' => 'Create Zila',
                    'slug' => 'admin.zilas.create',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleZilas->id,
                    'name' => 'Edit Zila',
                    'slug' => 'admin.zilas.edit',
                ]);
        
                Permission::updateOrCreate([
                    'module_id' => $moduleZilas->id,
                    'name' => 'Delete Zila',
                    'slug' => 'admin.zilas.destroy',
                ]);

        





    }
}
