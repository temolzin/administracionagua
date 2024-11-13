<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $costIds = DB::table('costs')->pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('customers')->insert([
                'cost_id' => $faker->randomElement($costIds),
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'block' => $faker->word,
                'street' => $faker->streetName,
                'interior_number' => $faker->numberBetween(1, 100),
                'marital_status' => $faker->boolean,
                'marital_status' => $faker->randomElement(['Casado/a', 'Soltero/a', 'Divorciado/a', 'Viudo/a']),
                'partner_name' => $faker->optional()->name,
                'has_water_connection' => $faker->boolean,
                'has_store' => $faker->boolean,
                'has_all_payments' => $faker->boolean,
                'has_water_day_night' => $faker->randomElement(['Día sí, noche no', 'Noche sí, día no']),
                'occupants_number' => $faker->numberBetween(1, 10),
                'water_days' => $faker->numberBetween(1, 7),
                'has_water_pressure' => $faker->randomElement(['Día sí, noche no', 'Noche sí, día no']),
                'has_cistern' => $faker->boolean,
                'state' => $faker->boolean,
                'status' => $faker->boolean,
                'observation' => $faker->text,
            ]);
        }
    }
}
