<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory;

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

        DB::table('users')->insert(
            [
                'user_firstname' => 'Luis',
                'user_lastname' => 'Cordero',
                'email' => 'luis.cordero@webdiv.co',
                'password' => bcrypt('gabriel02'),
                'user_rol_name' => 'admins',
                'user_number_id' => 'ID-001',
                'user_number_employee' => 'EID-001',
            ]
        );
        DB::table('users')->insert(
            [
                'user_firstname' => 'Juan',
                'user_lastname' => 'Cubillos',
                'email' => 'cubillos@webdiv.co',
                'password' => bcrypt('cubillos'),
                'user_rol_name' => 'admins',
                'user_number_id' => 'ID-002',
                'user_number_employee' => 'EID-002',
            ]
        );

        $faker = Faker\Factory::create();
        for ($i=0; $i < 100; $i++) { 
            DB::table('users')->insert(
	            [
	                'user_firstname' => $faker->firstName,
	                'user_lastname' => $faker->lastName,
	                'email' => $faker->unique()->email,
	                'password' => bcrypt($faker->password),
	                'user_rol_name' => 'admins',
	                'user_number_id' => $faker->unique()->uuid,
	                'user_number_employee' => $faker->unique()->uuid,
	            ]
	        );
        }
    }
}
