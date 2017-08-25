<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Eloquent::unguard();

        $this->call(UsersTypesTableSeeder);
        $this->call(RolesTableSeeder);
        $this->call(UsersPositionsTableSeeder);
        $this->call(UsersDivisionsTableSeeder);
        $this->call(VehiclesTypesTableSeeder);
        $this->call(VehiclesBrandsTableSeeder);
        $this->call(VehiclesModelsTableSeeder);
        $this->call(VehiclesColorsTableSeeder);
        # insertar usuarios para poder asignar vehiculos 
        $this->call(VehiclesTableSeeder);
        
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
