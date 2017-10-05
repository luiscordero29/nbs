<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('users_positions')->delete();
        for ($i=0; $i < 100; $i++) { 
        	DB::table('users_positions')->insert([
                'user_position_description' => $faker->unique()->realText($faker->numberBetween(10,60)),
            ]);
        }
    }
}
