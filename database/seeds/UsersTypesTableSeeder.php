<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('users_types')->delete();
        for ($i=0; $i < 100; $i++) { 
	        DB::table('users_types')->insert([
	            'user_type_description' => $faker->unique()->company,
	        ]);
	    }
    }
}
