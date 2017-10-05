<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory;

class VehiclesColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('vehicles_colors')->delete();
        for ($i=0; $i < 100; $i++) { 
            DB::table('vehicles_colors')->insert([
                'vehicle_color_name' => $faker->unique()->colorName,
            ]);
        }
    }
}