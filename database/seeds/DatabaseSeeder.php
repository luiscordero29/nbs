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

        $this->call(UsersTypesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersPositionsTableSeeder::class);
        $this->call(UsersDivisionsTableSeeder::class);
        $this->call(VehiclesTypesTableSeeder::class);
        $this->call(VehiclesBrandsTableSeeder::class);
        $this->call(VehiclesModelsTableSeeder::class);
        $this->call(VehiclesColorsTableSeeder::class);
        # insertar usuarios para poder asignar vehiculos 
        $this->call(VehiclesTableSeeder::class);
        
        DB::table('users')->delete();

        DB::table('users')->insert(
            [
                'user_firstname' => 'Luis',
                'user_lastname' => 'Cordero',
                'email' => 'luis.cordero@webdiv.co',
                'password' => bcrypt('gabriel02'),
                'user_type_description' => 'EMPLEADO TEMPORAL',
                'user_division_description' => 'DIVISION WEB',
                'user_position_description' => 'PROGRAMADOR',
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
                'user_type_description' => 'EMPLEADO TEMPORAL',
                'user_division_description' => 'DIVISION WEB',
                'user_position_description' => 'MASTER',
                'user_rol_name' => 'admins',
                'user_number_id' => 'ID-002',
                'user_number_employee' => 'EID-002',
            ]
        );
    }
}
