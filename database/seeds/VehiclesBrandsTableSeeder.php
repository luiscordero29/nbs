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
        $data = DB::table('vehicles_types')->limit(30)->get();
        foreach ($data as $r) {
            for ($i=0; $i < 5; $i++) { 
                DB::table('vehicles_brands')->insert([
                    'vehicle_type_name' => $r->vehicle_type_name,
                    'vehicle_brand_name' => $faker->unique()->name,
                    'vehicle_brand_description' => $faker->text,
                ]);
            }
        }
    }
}
