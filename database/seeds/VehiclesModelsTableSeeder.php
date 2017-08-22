<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;

class VehiclesModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('vehicles_models')->delete();
        $data = DB::table('vehicles_brands')->limit(30)->get();
	    foreach ($data as $r) {
	    	for ($i=0; $i < 5; $i++) { 
		        DB::table('vehicles_models')->insert([
		            'vehicle_brand_name' => $r->vehicle_brand_name,
		            'vehicle_model_name' => $faker->unique()->name,
		            'vehicle_model_description' => $faker->text,
		        ]);
		    }
	    }
    }
}
