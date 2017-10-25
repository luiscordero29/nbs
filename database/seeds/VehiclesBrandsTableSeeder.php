<?php
use Illuminate\Support\Facades\DB;
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
        $data = DB::table('vehicles_types')->get();
        foreach ($data as $r) {
            for ($i=0; $i < 33; $i++) { 
                DB::table('vehicles_brands')->insert([
                    'vehicle_type_name' => $r->vehicle_type_name,
                    'vehicle_brand_name' => $faker->unique()->realText($faker->numberBetween(10,60)),
                    'vehicle_brand_description' => $faker->text,
                ]);
            }
        }
    }
}
