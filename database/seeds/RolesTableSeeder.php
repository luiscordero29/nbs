<?php

use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

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
        
        $role = new Role;
        $role->role_name = 'admin';
        $role->role_description = 'Administrador';
        $role->role_uid  = Uuid::generate()->string;
        $role->save();

        $role = new Role;
        $role->role_name = 'user';
        $role->role_description = 'Usuario';
        $role->role_uid  = Uuid::generate()->string;
        $role->save();
    }
}
