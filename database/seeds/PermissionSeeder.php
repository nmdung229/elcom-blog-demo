<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'update articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'hide articles']);

        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('create articles');
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');
        $role1->givePermissionTo('update articles');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('publish articles');
        $role2->givePermissionTo('hide articles');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user1 = Factory(App\User::class)->create([
            'name' => 'User Test Permisson',
            'email' => 'test@gmail.com',
            'password' => bcrypt("123456")
        ]);
        // trao cho user role 1 (writer)
        $user1->assignRole($role1);

        $user2 = Factory(App\User::class)->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt("123456")
        ]);

        $user2->assignRole($role2);

        $user3 = Factory(App\User::class)->create([
            'name' => 'SuperAdmin User',
            'email' => 'superadmin@gamil.com',
            'password' => bcrypt("123456")

        ]);

        $user3->assignRole($role3);
    }
}
