<?php

use App\ParkingSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class ParkingsSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parkings_sections')->delete();
        $parking_section = new ParkingSection;
        $parking_section->parking_section_name = 'PARQUEADERO PARA VEHICULOS';
        $parking_section->parking_section_uid  = Uuid::generate()->string;
        $parking_section->save();
        $parking_section = new ParkingSection;
        $parking_section->parking_section_name = 'PARQUEADERO PARA MOTOS';
        $parking_section->parking_section_uid  = Uuid::generate()->string;
        $parking_section->save();
    }
}
