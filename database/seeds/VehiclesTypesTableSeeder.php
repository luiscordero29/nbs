<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class VehiclesTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles_types')->delete();
        DB::table('vehicles_types')->insert([
            'vehicle_type_name' => 'BICICLETA',
            'vehicle_type_description' => 'VEHICULO EN DOS RUEDAS',
        ]);
        DB::table('vehicles_types')->insert([
            'vehicle_type_name' => 'MOTO',
            'vehicle_type_description' => 'VEHICULO DE MOTOR EN DOS RUEDAS',
        ]);
        DB::table('vehicles_types')->insert([
            'vehicle_type_name' => 'VEHICULO',
            'vehicle_type_description' => 'VEHICULO DE MOTOR EN CUATRO RUEDAS',
        ]);
    }
}
