<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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
            ]
        );
        DB::table('users')->insert(
            [
                'user_firstname' => 'Juan',
                'user_lastname' => 'Cubillos',
                'email' => 'cubillos@webdiv.co',
                'password' => bcrypt('cubillos'),
            ]
        );

        $this->call(UsersTypesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersChargesTableSeeder::class);
        $this->call(UsersDivisionsTableSeeder::class);
        $this->call(VehiclesTypesTableSeeder::class);
        $this->call(VehiclesBrandsTableSeeder::class);
        $this->call(VehiclesModelsTableSeeder::class);
    }
}
