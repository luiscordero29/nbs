<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class VehiclesBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('vehicles_brands')->delete();
        for ($i=0; $i < 100; $i++) { 
	        DB::table('vehicles_brands')->insert([
	            'vehicle_brand_name' => $faker->unique()->name,
	            'vehicle_brand_description' => $faker->text,
	        ]);
	    }
    }
}
