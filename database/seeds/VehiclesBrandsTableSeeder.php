<?php

use App\VehicleType;
use App\VehicleBrand;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

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
        $data = VehicleType::get();
        foreach ($data as $r) {
            for ($i=0; $i < 30; $i++) { 
                $vehicle_brand = new VehicleBrand;
                $vehicle_brand->vehicle_brand_name = $faker->unique()->realText($faker->numberBetween(10,60));
                $vehicle_brand->vehicle_brand_uid  = Uuid::generate()->string;
                $vehicle_brand->vehicle_type_uid  = $r->vehicle_type_uid;
                $vehicle_brand->save();
            }
        }
    }
}
