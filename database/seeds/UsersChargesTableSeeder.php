<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersChargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('users_charges')->delete();
        for ($i=0; $i < 100; $i++) { 
	        DB::table('users_charges')->insert([
	            'user_charge_description' => $faker->unique()->company,
	        ]);
	    }
    }
}
