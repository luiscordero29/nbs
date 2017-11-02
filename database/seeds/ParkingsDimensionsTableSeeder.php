<?php

use App\ParkingDimension;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class ParkingsDimensionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('parkings_dimensions')->delete();
        for ($i=0; $i < 100; $i++) { 
            $parkings_dimension = new ParkingDimension;
            $parkings_dimension->parking_dimension_name = $faker->unique()->realText($faker->numberBetween(10,60));
            $parkings_dimension->parking_dimension_size = $faker->unique()->realText($faker->numberBetween(10,30));
            $parkings_dimension->parking_dimension_long = $faker->numberBetween(1,3);
            $parkings_dimension->parking_dimension_height = $faker->numberBetween(1,3);
            $parkings_dimension->parking_dimension_width = $faker->numberBetween(1,3);
            $parkings_dimension->parking_dimension_uid  = Uuid::generate()->string;
            $parkings_dimension->save();
        }
    }
}
