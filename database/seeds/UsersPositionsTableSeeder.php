<?php

use App\UserPosition;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

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
            $user_position = new UserPosition;
            $user_position->user_position_description = $faker->unique()->realText($faker->numberBetween(10,60));
            $user_position->user_position_uid  = Uuid::generate()->string;
            $user_position->save();
        }
    }
}
