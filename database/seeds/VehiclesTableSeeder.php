<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory;

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
        $types = DB::table('vehicles_types')->get();
        $users = DB::table('users')->get();
        $faker = Faker\Factory::create();
        foreach ($users as $u) {
            foreach ($types as $t) { 
                DB::table('vehicles')->insert([
                    'vehicle_type_name' => $t->vehicle_type_name,
                    'user_number_id' => $u->user_number_id,
                    'vehicle_code' => $faker->unique()->ean8,
                ]);
            }
        }
    }
}
