<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Pharmacy;
use App\Models\EndUser;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'manage pharmacies']); //crud on pharmacy
        Permission::create(['name' => 'manage doctors']);
        Permission::create(['name' => 'manage end users']);
        Permission::create(['name' => 'manage areas']);
        Permission::create(['name' => 'manage addresses']);
        Permission::create(['name' => 'manage medicines']);
        Permission::create(['name' => 'manage orders']);

        Permission::create(['name' => 'manage own doctors']); //crud on own doctors
        Permission::create(['name' => 'update own pharmacy']); //edit own pharmacy info except area and priority

        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'edit orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'update order status']);

        Permission::create(['name' => 'manage own addresses']);
        Permission::create(['name' => 'manage own orders']);
        Permission::create(['name' => 'update own user info']); //edit own info except email


        // create roles and assign existing permissions
        $doctor_role = Role::create(['name' => 'doctor']);
        $doctor_role->givePermissionTo('update order status');

        $user_role = Role::create(['name' => 'end_user']);
        $user_role->givePermissionTo(['manage own addresses', 'manage own orders', 'update own user info']);

        $pharmacy_role = Role::create(['name' => 'pharmacy']);
        $pharmacy_role->givePermissionTo(['manage own doctors', 'update own pharmacy', 'view orders', 'edit orders', 'delete orders']);

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->syncPermissions(Permission::all());
        
        // $admin = Admin::factory()->create();
        // $admin->type()->create([
        //     'email' => 'admin@example.com',
        //     'password' => bcrypt('123456'),
        // ]);
        // Admin::factory()->create()->assignRole($admin_role)->each(function ($user) {
        //     $user->type()->save(User::factory()->create(
        //         [
        //             'email' => 'admin@example.com',
        //             'password' => bcrypt('123456'),
        //         ]
        //     ));
        // });

        $pharmacies = User::where('typeable_type', Pharmacy::class)->get();
        foreach ($pharmacies as $pharmacy) {
            $pharmacy->assignRole($pharmacy_role);
        }

        $doctors = User::where('typeable_type', Doctor::class)->get();
        foreach ($doctors as $doctor) {
            $doctor->assignRole($doctor_role);
        }

        $end_users = User::where('typeable_type', Patient::class)->get();
        foreach ($end_users as $end_user) {
            $end_user->assignRole($user_role);
        }
        $admins = User::where('typeable_type', Admin::class)->get();
        foreach ($admins as $admin) {
            $admin->assignRole($admin_role);
        }

        // // Create an admin user
        // $admin = Admin::create([
        //     'email' => 'admin@example.com',
        //     'password' => bcrypt('password'),
        // ]);
        // $admin->assignRole($admin_role);

        // // Create a doctor user
        // $doctor = Doctor::create([
        //     'email' => 'doctor@example.com',
        //     'password' => bcrypt('password'),
        // ]);
        // $doctor->assignRole($doctor_role);

        // // Create a pharmacy user
        // $pharmacy = Pharmacy::create([
        //     'email' => 'pharmacy@example.com',
        //     'password' => bcrypt('password'),
        // ]);
        // $pharmacy->assignRole($pharmacy_role);

        // // Create an end user
        // $endUser = EndUser::create([
        //     'email' => 'user@example.com',
        //     'password' => bcrypt('password'),
        // ]);
        // $endUser->assignRole($user_role);

        // gets all permissions via Gate::before rule; see AuthServiceProvider

        //create demo users

        // $user = \App\Models\User::factory()->create([
        //     'email' => 'admin@example.com',
        //     'password' => '123456',
        //     'type'=>'admin'
        // ]); 
        // $user->assignRole($admin_role);

        // $user = \App\Models\User::factory()->create([
        //     'email' => 'doctor@example.com',
        //     'password' => '123456',
        //     'type'=>'doctor'
        // ]);
        // $user->assignRole($doctor_role);

        // $user = \App\Models\User::factory()->create([
        //     'email' => 'pharmacy@admin.com',
        //     'password' => '123456',
        //     'type'=>'pharmacy'

        // ]);
        // $user->assignRole($pharmacy_role);

        // $user = \App\Models\User::factory()->create([
        //     'email' => 'end_user@example.com',
        //     'password' => '123456',
        //     'type'=>'end_user'

        // ]);
        // $user->assignRole($user_role);


    }
}
