<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit pharmacies']);
        Permission::create(['name' => 'delete pharmacies']);
        Permission::create(['name' => 'create pharmacies']);
        Permission::create(['name' => 'view pharmacies']);

        Permission::create(['name' => 'edit doctors']);
        Permission::create(['name' => 'delete doctors']);
        Permission::create(['name' => 'create doctors']);
        Permission::create(['name' => 'view doctors']);

        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'view users']);

        Permission::create(['name' => 'edit areas']);
        Permission::create(['name' => 'delete areas']);
        Permission::create(['name' => 'create areas']);
        Permission::create(['name' => 'view areas']);

        Permission::create(['name' => 'edit addresses']);
        Permission::create(['name' => 'delete addresses']);
        Permission::create(['name' => 'create addresses']);
        Permission::create(['name' => 'view addresses']);

        Permission::create(['name' => 'edit medicines']);
        Permission::create(['name' => 'delete medicines']);
        Permission::create(['name' => 'create medicines']);
        Permission::create(['name' => 'view medicines']);

        Permission::create(['name' => 'edit orders']);
        Permission::create(['name' => 'delete orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'view orders']);

        // create roles and assign existing permissions
        $doctor_role = Role::create(['name' => 'doctor']);
        $doctor_role->givePermissionTo('');
        

        $user_role = Role::create(['name' => 'user']);
        

        $admin_role = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($doctor_role);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($user_role);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($admin_role);
    }
}
