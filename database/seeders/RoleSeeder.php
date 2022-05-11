<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = Permission::all();
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'description of admin',
            'deletable' => false,
        ])->permissions()->sync($adminPermissions->pluck('id'));

        Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => 'description of user',
            'deletable' => false,
        ]);
    }
}
