<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
