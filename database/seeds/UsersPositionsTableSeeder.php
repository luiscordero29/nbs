<?php

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
        DB::table('users_positions')->insert(
            [
                'user_position_description' => 'PROGRAMADOR',
            ]
        );
        DB::table('users_positions')->insert(
            [
                'user_position_description' => 'MASTER',
            ]
        );
        for ($i=0; $i < 100; $i++) { 
	        DB::table('users_positions')->insert([
	            'user_position_description' => $faker->unique()->company,
	        ]);
	    }
    }
}
