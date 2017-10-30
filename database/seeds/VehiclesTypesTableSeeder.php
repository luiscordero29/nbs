<?php

use App\VehicleType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

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
        
        $vehicle_type = New VehicleType;
        $vehicle_type->vehicle_type_name = 'MOTO';
        $vehicle_type->vehicle_type_description = 'VEHICULO DE MOTOR EN DOS RUEDAS';
        $vehicle_type->vehicle_type_uid  = Uuid::generate()->string;
        $vehicle_type->save();
        
        $vehicle_type = New VehicleType;
        $vehicle_type->vehicle_type_name = 'VEHICULO';
        $vehicle_type->vehicle_type_description = 'VEHICULO DE MOTOR EN CUATRO RUEDAS';
        $vehicle_type->vehicle_type_uid  = Uuid::generate()->string;
        $vehicle_type->save();    
    }
}
