<?php

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
	        	'rol_description' => 'USUARIOS',
	        	'rol_protected' => 'yes',
	    	]
	    );
        DB::table('roles')->insert(
            [
                'rol_name' => 'admins',
                'rol_description' => 'ADMINISTRADORES',
                'rol_protected' => 'yes',
            ]
        );
    }
}
