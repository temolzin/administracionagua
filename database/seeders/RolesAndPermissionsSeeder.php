<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleManager = Role::create(['name' => 'manager']);
        $roleSecretariat = Role::create(['name' => 'secretariat']);
      
        Permission::create([
            'name' => 'viewUser',
            'description' => 'Permite ver los Usuario.'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name' => 'viewRoles',
            'description' => 'Permite ver los Roles.'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name' => 'viewCustomers',
            'description' => 'Permite ver los Clientes.'
        ])->assignRole([$roleManager, $roleSecretariat ]);
        Permission::create([
            'name' => 'viewPayments',
            'description' => 'Permite ver los Pagos.'
        ])->assignRole([$roleManager, $roleSecretariat ]);
        Permission::create([
            'name' => 'viewDebts',
            'description' => 'Permite ver las Deudas.'
        ])->assignRole([$roleManager, $roleSecretariat ]);

    }
}

