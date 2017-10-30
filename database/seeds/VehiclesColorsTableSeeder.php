<?php

use App\VehicleColor;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class VehiclesColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('vehicles_colors')->delete();
        for ($i=0; $i < 100; $i++) { 
            $vehicle_color = new VehicleColor;
            $vehicle_color->vehicle_color_name = $faker->unique()->colorName;
            $vehicle_color->vehicle_color_uid  = Uuid::generate()->string;
            $vehicle_color->save();
        }
    }
}
