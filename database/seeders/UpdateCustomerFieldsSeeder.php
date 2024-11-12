<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateCustomerFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('customers')->where('marital_status', '1')->update(['marital_status' => 'Casado/a']);
         DB::table('customers')->where('marital_status', '0')->update(['marital_status' => 'Soltero/a']);

         DB::table('customers')->where('has_water_day_night', '1')->update(['has_water_day_night' => 'Día sí, noche no']);
         DB::table('customers')->where('has_water_day_night', '0')->update(['has_water_day_night' => 'Noche sí, día no']);

         DB::table('customers')->where('has_water_pressure', '1')->update(['has_water_pressure' => 'Día sí, noche no']);
         DB::table('customers')->where('has_water_pressure', '0')->update(['has_water_pressure' => 'Noche sí, día no']);
    }
}
