<?php

use App\User;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        $user = new User;
        $user->user_firstname = 'Luis';
        $user->user_lastname = 'Cordero';
        $user->email = 'luis.cordero@webdiv.co';
        $user->password = bcrypt('gabriel02');
        $user->user_number_id = 'ID-001';
        $user->rol_name = 'admin';
        $user->user_number_employee = 'EID-001';
        $user->user_uid  = Uuid::generate()->string;
        $user->save();

        $user = new User;
        $user->user_firstname = 'Juan';
        $user->user_lastname = 'Cubillos';
        $user->email = 'cubillos@webdiv.co';
        $user->password = bcrypt('cubillos');
        $user->user_number_id = 'ID-002';
        $user->rol_name = 'admin';
        $user->user_number_employee = 'EID-002';
        $user->user_uid  = Uuid::generate()->string;
        $user->save();

        $faker = Faker\Factory::create();
        for ($i=0; $i < 100; $i++) { 
            $user = new User;
            $user->user_firstname = $faker->firstName;
            $user->user_lastname = $faker->lastName;
            $user->email = $faker->unique()->email;
            $user->password = bcrypt($faker->password);
            $user->rol_name = 'user';
            $user->user_number_id = $faker->unique()->uuid;
            $user->user_number_employee = $faker->unique()->uuid;
            $user->user_uid  = Uuid::generate()->string;
            $user->save();
        }
    }
}
