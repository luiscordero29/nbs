<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

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
        DB::table('parkings_sections')->insert(
            [
                'parking_section_name' => 'PARQUEADERO PARA VEHICULOS',
            ]
        );
        DB::table('parkings_sections')->insert(
            [
                'parking_section_name' => 'PARQUEADERO PARA MOTOS',
            ]
        );
        DB::table('parkings_sections')->insert(
            [
                'parking_section_name' => 'PARQUEADERO PARA BICICLETAS',
            ]
        );
    }
}
