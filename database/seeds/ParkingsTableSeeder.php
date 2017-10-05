<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory;

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
        $parkings_sections = DB::table('parkings_sections')->get();
        $vehicles_types = DB::table('vehicles_types')->get();
        foreach ($parkings_sections as $s) {
        	foreach ($vehicles_types as $t) {            
	            for ($i=0; $i < 10; $i++) { 
	                DB::table('parkings')->insert([
	                    'parking_section_name' => $s->parking_section_name,
	                    'vehicle_type_name' => $t->vehicle_type_name,
	                    'parking_name' => $faker->unique()->realText($faker->numberBetween(10,60)),
	                ]);
	            }
	        }
        }
    }
}
