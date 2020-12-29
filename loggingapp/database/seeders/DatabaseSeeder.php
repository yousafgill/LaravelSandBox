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
            Permission::create(['name'=>'role-list']);
            Permission::create(['name'=>'role-create']);
            Permission::create(['name'=>'role-edit']);
            Permission::create(['name'=>'role-delete']);
            Permission::create(['name'=>'user-list']);
            Permission::create(['name'=>'user-create']);
            Permission::create(['name'=>'user-edit']);
            Permission::create(['name'=>'user-delete']);

      
            // create roles and assign created permissions
      
              
            //Create Super Admin Role and Assign All permissions
            $role_super_admin = Role::create(['name' => 'Super Admin']);
            $role_super_admin->givePermissionTo(Permission::all());
      
      
            //Create Admin Role & Assign Some Permissions
            $role_admin = Role::create(['name' => 'Admin']);
            $role_admin->givePermissionTo(['user-list', 'user-create','role-list']);
      
      
            // or may be done by chaining
            $role_user = Role::create(['name' => 'User'])
                ->givePermissionTo(['user-list']);
            
            $role_guest=Role::create(['name'=>'Guest'])
                ->givePermissionTo(['user-list']);
      
            $user_super_admin=User::create([
                 'name'=>'Super Admin',
                 'email'=>'sa@localhost.com',
                 'password'=>Hash::make('sa1234'),
            ]);
             
            $user_super_admin->assignRole($role_super_admin);
      
            $user_admin=User::create([
                'name'=>'Admin',
                'email'=>'admin@localhost.com',
                'password'=>Hash::make('admin1234'),
            ]);
          

            $user_admin->assignRole($role_admin);
          
            
            $user_user=User::create([
                'name'=> 'User',
                'email' => 'user@localhost.com',
                'password'=> Hash::make('user1234'),
            ]);

            $user_user ->assignRole($role_user);
    }
}