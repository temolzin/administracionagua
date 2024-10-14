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
        $roleSecretariat = Role::create(['name' => 'secretariat']);
      
        Permission::create([
            'name' => 'viewUser',
            'description' => 'Permite ver, editar y eliminar los administradores.'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name' => 'viewRoles',
            'description' => 'Permite ver y editar los roles.'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name' => 'viewCustomers',
            'description' => 'Permite ver los administradores.'
        ])->assignRole([$roleAdmin, $roleSecretariat ]);
        Permission::create([
            'name' => 'editCustomer',
            'description' => 'Permite editar los usuarios.'
        ])->assignRole([$roleAdmin]);
        Permission::create([
            'name' => 'deleteCustomer',
            'description' => 'Permite eliminar los usuarios.'
        ])->assignRole([$roleAdmin ]);
        Permission::create([
            'name' => 'viewPayments',
            'description' => 'Permite ver los pagos.'
        ])->assignRole([$roleAdmin, $roleSecretariat ]);
        Permission::create([
            'name' => 'editPayment',
            'description' => 'Permite editar los pagos.'
        ])->assignRole([$roleAdmin]);
        Permission::create([
            'name' => 'deletePayment',
            'description' => 'Permite eliminar los pagos.'
        ])->assignRole([$roleAdmin]);
        Permission::create([
            'name' => 'viewDebts',
            'description' => 'Permite ver las deudas.'
        ])->assignRole([$roleAdmin, $roleSecretariat ]);
        Permission::create([
            'name' => 'editDebts',
            'description' => 'Permite editar la deuda.'
        ])->assignRole([$roleAdmin ]);
        Permission::create([
            'name' => 'deleteDebt',
            'description' => 'Permite eliminar la deuda.'
        ])->assignRole([$roleAdmin]);
        Permission::create([
            'name' => 'viewCost',
            'description' => 'Permite ver los Costos.'
        ])->assignRole([$roleAdmin, $roleSecretariat ]);
        Permission::create([
            'name' => 'editCost',
            'description' => 'Permite editar los costos.'
        ])->assignRole([$roleAdmin]);
        Permission::create([
            'name' => 'deleteCost',
            'description' => 'Permite eliminar los costos.'
        ])->assignRole([$roleAdmin]);
    }
}

