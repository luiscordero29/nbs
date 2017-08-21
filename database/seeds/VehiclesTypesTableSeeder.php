<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class VehiclesTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('vehicles_types')->delete();
        for ($i=0; $i < 100; $i++) { 
	        DB::table('vehicles_types')->insert([
	            'vehicle_type_name' => $faker->unique()->name,
	            'vehicle_type_description' => $faker->text,
	        ]);
	    }
    }
}
