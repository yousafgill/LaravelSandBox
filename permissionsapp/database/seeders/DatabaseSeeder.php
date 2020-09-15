<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);
        Permission::create(['name'=>'role-list']);
        Permission::create(['name'=>'role-create']);
        Permission::create(['name'=>'role-edit']);
        Permission::create(['name'=>'role-delete']);
        Permission::create(['name'=>'user-list']);
        Permission::create(['name'=>'user-create']);
        Permission::create(['name'=>'user-edit']);
        Permission::create(['name'=>'user-delete']);
        Permission::create(['name'=>'product-list']);
        Permission::create(['name'=>'product-create']);
        Permission::create(['name'=>'product-edit']);
        Permission::create(['name'=>'product-delete']);

        // create roles and assign created permissions

        
        //Create Super Admin Role and Assign All permissions
        $role_super_admin = Role::create(['name' => 'super-admin']);
        $role_super_admin->givePermissionTo(Permission::all());


        //Create Admin Role & Assign Some Permissions
        $role_admin = Role::create(['name' => 'admin']);
        $role_admin->givePermissionTo(Permission::all());

        // this can be done as separate statements
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');

        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish articles', 'unpublish articles']);

       $user_super_admin=User::create([
           'name'=>'Super Admin',
           'email'=>'sa@pislides.com',
           'password'=>Hash::make('sa12345678'),
       ]);
       
       $user_super_admin->assignRole($role_super_admin);

       $user_admin=User::create([
        'name'=>'Admin',
        'email'=>'admin@pislides.com',
        'password'=>Hash::make('admin12345678'),
        ]);
    
        $user_admin->assignRole($role_admin);
    
       

    }
}