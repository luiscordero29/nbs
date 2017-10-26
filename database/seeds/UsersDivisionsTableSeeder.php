<?php

use App\UserDivision;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

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
        for ($i=0; $i < 100; $i++) { 
            $user_division = new UserDivision;
            $user_division->user_division_description = $faker->unique()->realText($faker->numberBetween(10,60));
            $user_division->user_division_uid  = Uuid::generate()->string;
            $user_division->save();
        }
    }
}
