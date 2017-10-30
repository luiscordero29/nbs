<?php

use App\VehicleBrand;
use App\VehicleModel;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

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
        $data = VehicleBrand::limit(30)->get();
        foreach ($data as $r) {
            for ($i=0; $i < 5; $i++) { 
                $vehicle_model = new VehicleModel;
                $vehicle_model->vehicle_model_name = $faker->unique()->realText($faker->numberBetween(10,60));
                $vehicle_model->vehicle_model_description = $faker->text;
                $vehicle_model->vehicle_model_uid  = Uuid::generate()->string;
                $vehicle_model->vehicle_brand_uid  = $r->vehicle_brand_uid;
                $vehicle_model->save();
            }
        }
    }
}