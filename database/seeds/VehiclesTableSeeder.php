<?php

use App\User;
use App\Vehicle;
use App\VehicleType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->delete();
        $types = VehicleType::get();
        $users = User::get();
        $faker = Faker\Factory::create();
        foreach ($users as $u) {
            foreach ($types as $t) { 
                $vehicle = New Vehicle;
                $vehicle->vehicle_type_uid = $t->vehicle_type_uid;
                $vehicle->user_uid = $u->user_uid;
                $vehicle->vehicle_code = $faker->unique()->ean8;
                $vehicle->vehicle_uid  = Uuid::generate()->string;
                $vehicle->save();
            }
        }
    }
}
