<?php

use App\UserType;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

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
            $user_type = new UserType;
            $user_type->user_type_description = $faker->unique()->realText($faker->numberBetween(10,60));
            $user_type->user_type_uid  = Uuid::generate()->string;
            $user_type->save();
        }
    }
}
