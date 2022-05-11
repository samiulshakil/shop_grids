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
        $moduleDashboard = Module::create(['name'=> 'Admin Dashboard']);

        Permission::create([
            'module_id' => $moduleDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'admin.dashboard',
        ]);

        //Role Management
        $moduleRole = Module::create(['name'=> 'Role Management']);

        Permission::create([
            'module_id' => $moduleRole->id,
            'name' => 'Access Role',
            'slug' => 'admin.roles.index',
        ]);

        Permission::create([
            'module_id' => $moduleRole->id,
            'name' => 'Create Role',
            'slug' => 'admin.roles.create',
        ]);

        Permission::create([
            'module_id' => $moduleRole->id,
            'name' => 'Edit Role',
            'slug' => 'admin.roles.edit',
        ]);

        Permission::create([
            'module_id' => $moduleRole->id,
            'name' => 'Delete Role',
            'slug' => 'admin.roles.destroy',
        ]);

        //User Management
        $moduleUser = Module::create(['name'=> 'User Management']);

        Permission::create([
            'module_id' => $moduleUser->id,
            'name' => 'Access User',
            'slug' => 'admin.users.index',
        ]);

        Permission::create([
            'module_id' => $moduleUser->id,
            'name' => 'Create User',
            'slug' => 'admin.users.create',
        ]);

        Permission::create([
            'module_id' => $moduleUser->id,
            'name' => 'Edit User',
            'slug' => 'admin.users.edit',
        ]);

        Permission::create([
            'module_id' => $moduleUser->id,
            'name' => 'Delete User',
            'slug' => 'admin.users.destroy',
        ]);

        //Backup Management
        $moduleBackups = Module::create(['name'=> 'Backup Management']);

        Permission::create([
            'module_id' => $moduleBackups->id,
            'name' => 'Access Backup',
            'slug' => 'admin.backups.index',
        ]);

        Permission::create([
            'module_id' => $moduleBackups->id,
            'name' => 'Create Backup',
            'slug' => 'admin.backups.create',
        ]);

        Permission::create([
            'module_id' => $moduleBackups->id,
            'name' => 'Download Backup',
            'slug' => 'admin.backups.download',
        ]);

        Permission::create([
            'module_id' => $moduleBackups->id,
            'name' => 'Delete Backup',
            'slug' => 'admin.backups.destroy',
        ]);

        //Page Management
        $modulePages = Module::create(['name'=> 'Page Management']);

        Permission::create([
            'module_id' => $modulePages->id,
            'name' => 'Access Page',
            'slug' => 'admin.pages.index',
        ]);

        Permission::create([
            'module_id' => $modulePages->id,
            'name' => 'Create Page',
            'slug' => 'admin.pages.create',
        ]);

        Permission::create([
            'module_id' => $modulePages->id,
            'name' => 'Edit Page',
            'slug' => 'admin.pages.edit',
        ]);

        Permission::create([
            'module_id' => $modulePages->id,
            'name' => 'Delete Page',
            'slug' => 'admin.pages.destroy',
        ]);

         //Menu Management
         $moduleMenu = Module::create(['name'=> 'Menu Management']);

         Permission::create([
             'module_id' => $moduleMenu->id,
             'name' => 'Access Menu',
             'slug' => 'admin.menus.index',
         ]);

         Permission::create([
             'module_id' => $moduleMenu->id,
             'name' => 'Access Menu Builder',
             'slug' => 'admin.menus.builder',
         ]);
 
         Permission::create([
             'module_id' => $moduleMenu->id,
             'name' => 'Create Menu',
             'slug' => 'admin.menus.create',
         ]); 
 
         Permission::create([
             'module_id' => $moduleMenu->id,
             'name' => 'Edit Menu',
             'slug' => 'admin.menus.edit',
         ]);
 
         Permission::create([
             'module_id' => $moduleMenu->id,
             'name' => 'Delete Menu',
             'slug' => 'admin.menus.destroy',
         ]);

          //Menu Management
          $moduleSetting = Module::create(['name'=> 'Setting Management']);

          Permission::create([
            'module_id' => $moduleSetting->id,
            'name' => 'Access Setting',
            'slug' => 'admin.settings.index',
        ]);
    }
}
