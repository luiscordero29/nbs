<?php

use App\Parking;
use App\ParkingSection;
use App\VehicleType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class ParkingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('parkings')->delete();
        $parkings_sections = ParkingSection::get();
        $vehicles_types = VehicleType::get();
        foreach ($parkings_sections as $s) {
        	foreach ($vehicles_types as $t) {            
	            for ($i=0; $i < 5; $i++) { 
                    $parking = new Parking;
                    $parking->parking_section_uid = $s->parking_section_uid;
                    $parking->vehicle_type_uid  = $t->vehicle_type_uid;
                    $parking->parking_name  = $faker->unique()->realText($faker->numberBetween(10,60));
                    $parking->parking_uid  = Uuid::generate()->string;
                    $parking->save();
	            }
	        }
        }
    }
}
