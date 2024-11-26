<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'id' => 2096,
            'cost_id' => 1,
            'name' => 'Martha',
            'last_name' => 'García Beltrán',
            'block' => 'B',
            'street' => 'Calle Secundaria',
            'interior_number' => null,
            'marital_status' => 'Casado/a',
            'partner_name' => null,
            'has_water_connection' => null,
            'has_store' => null,
            'has_all_payments' => null,
            'has_water_day_night' => null,
            'occupants_number' => null,
            'water_days' => null,
            'has_water_pressure' => null,
            'has_cistern' => null,
            'state' => true,
            'status' => true,
            'observation' => null,
            'responsible_name' => null,
        ]);

        Customer::create([
            'id' => 2097,
            'cost_id' => 1,
            'name' => 'Adriana',
            'last_name' => 'Romano Velázquez',
            'block' => 'B',
            'street' => 'Calle Secundaria',
            'interior_number' => null,
            'marital_status' => 'Casado/a',
            'partner_name' => null,
            'has_water_connection' => null,
            'has_store' => null,
            'has_all_payments' => null,
            'has_water_day_night' => null,
            'occupants_number' => null,
            'water_days' => null,
            'has_water_pressure' => null,
            'has_cistern' => null,
            'state' => true,
            'status' => true,
            'observation' => null,
            'responsible_name' => null,
        ]);

        Customer::create([
            'id' => 2098,
            'cost_id' => 1,
            'name' => 'Sergio',
            'last_name' => 'Sandoval Sánchez',
            'block' => 'B',
            'street' => 'Calle Secundaria',
            'interior_number' => null,
            'marital_status' => 'Casado/a',
            'partner_name' => null,
            'has_water_connection' => null,
            'has_store' => null,
            'has_all_payments' => null,
            'has_water_day_night' => null,
            'occupants_number' => null,
            'water_days' => null,
            'has_water_pressure' => null,
            'has_cistern' => null,
            'state' => true,
            'status' => true,
            'observation' => null,
            'responsible_name' => null,
        ]);
    }
}

