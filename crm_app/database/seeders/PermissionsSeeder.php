<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit company']);
        Permission::create(['name' => 'delete company']);
        Permission::create(['name' => 'view comapny']);
        Permission::create(['name' => 'add company']);

        Permission::create(['name' => 'edit contact']);
        Permission::create(['name' => 'delete contact']);
        Permission::create(['name' => 'view contact']);
        Permission::create(['name' => 'add contact']);

        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'add user']);

        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('edit company');
        $role1->givePermissionTo('delete company');
        $role1->givePermissionTo('edit company');
        $role1->givePermissionTo('delete company');
        $role1->givePermissionTo('edit company');
        $role1->givePermissionTo('delete company');
        $role1->givePermissionTo('edit contact');
        $role1->givePermissionTo('delete contact');
        $role1->givePermissionTo('edit contact');
        $role1->givePermissionTo('delete contact');
        $role1->givePermissionTo('edit contact');
        $role1->givePermissionTo('delete contact');

        Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider


    }
}
