<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('types')->delete();
        for ($i=0; $i < 100; $i++) { 
	        DB::table('types')->insert([
	            'type_description' => $faker->unique()->company,
	        ]);
	    }
    }
}
