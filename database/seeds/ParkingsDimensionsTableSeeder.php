<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory;

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
        	DB::table('parkings_dimensions')->insert([
                'parking_dimension_name' => $faker->unique()->realText($faker->numberBetween(10,60)),
                'parking_dimension_size' => $faker->unique()->realText($faker->numberBetween(10,30)),
                'parking_dimension_long' => $faker->numberBetween(1,3),
                'parking_dimension_height' => $faker->numberBetween(1,3),
                'parking_dimension_width' => $faker->numberBetween(1,3),
            ]);
        }
    }
}
