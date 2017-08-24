<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersDivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('users_divisions')->delete();
        DB::table('users_divisions')->insert(
            [
                'user_division_description' => 'DIVISION WEB',
            ]
        );
        for ($i=0; $i < 100; $i++) { 
	        DB::table('users_divisions')->insert([
	            'user_division_description' => $faker->unique()->company,
	        ]);
	    }
    }
}
