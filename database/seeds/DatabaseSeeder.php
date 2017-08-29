<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        # Table users_types
        DB::table('users_types')->delete();
        DB::table('users_types')->insert(
            [
                'user_type_description' => 'EMPLEADO TEMPORAL',
            ]
        );
        for ($i=0; $i < 100; $i++) { 
            DB::table('users_types')->insert([
                'user_type_description' => $faker->unique()->company,
            ]);
        }
        # Table roles
        DB::table('roles')->delete();
        DB::table('roles')->insert(
            [
                'rol_name' => 'users',
                'rol_description' => 'USUARIO',
                'rol_protected' => 'yes',
            ]
        );
        DB::table('roles')->insert(
            [
                'rol_name' => 'admins',
                'rol_description' => 'ADMINISTRADOR',
                'rol_protected' => 'yes',
            ]
        );
        # Table users_positions
        DB::table('users_positions')->delete();
        DB::table('users_positions')->insert(
            [
                'user_position_description' => 'PROGRAMADOR',
            ]
        );
        DB::table('users_positions')->insert(
            [
                'user_position_description' => 'MASTER',
            ]
        );
        for ($i=0; $i < 100; $i++) { 
            DB::table('users_positions')->insert([
                'user_position_description' => $faker->unique()->company,
            ]);
        }
        # Table users_divisiones
        DB::table('users_divisions')->delete();
        DB::table('users_divisions')->insert(
            [
                'user_division_description' => 'DIVISION WEB',
            ]
        );
        for ($i=0; $i < 100; $i++) { 
            DB::table('users_divisions')->insert([
                'user_division_description' => $faker->unique()->company,
            ]);
        }
        # Table vehicles_types
        DB::table('vehicles_types')->delete();
        for ($i=0; $i < 100; $i++) { 
            DB::table('vehicles_types')->insert([
                'vehicle_type_name' => $faker->unique()->name,
                'vehicle_type_description' => $faker->text,
            ]);
        }
        # Table vehicle_brans
        DB::table('vehicles_brands')->delete();
        $data = DB::table('vehicles_types')->limit(30)->get();
        foreach ($data as $r) {
            for ($i=0; $i < 5; $i++) { 
                DB::table('vehicles_brands')->insert([
                    'vehicle_type_name' => $r->vehicle_type_name,
                    'vehicle_brand_name' => $faker->unique()->name,
                    'vehicle_brand_description' => $faker->text,
                ]);
            }
        }
        # Table vehicles_models
        DB::table('vehicles_models')->delete();
        $data = DB::table('vehicles_brands')->limit(30)->get();
        foreach ($data as $r) {
            for ($i=0; $i < 5; $i++) { 
                DB::table('vehicles_models')->insert([
                    'vehicle_brand_name' => $r->vehicle_brand_name,
                    'vehicle_model_name' => $faker->unique()->name,
                    'vehicle_model_description' => $faker->text,
                ]);
            }
        }
        # Table vehicles_colors
        DB::table('vehicles_colors')->delete();
        for ($i=0; $i < 60; $i++) { 
            DB::table('vehicles_colors')->insert([
                'vehicle_color_name' => $faker->unique()->name,
            ]);
        }
        # Table users
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
