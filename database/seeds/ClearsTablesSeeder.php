<?php

use Illuminate\Database\Seeder;

class ClearsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('password_resets')->delete();
        DB::table('users_types')->delete();
        DB::table('users_positions')->delete();
        DB::table('users_divisions')->delete();
        DB::table('roles')->delete();
        #DB::table('vehicles')->delete();
        #DB::table('colors')->delete();
        DB::table('vehicles_models')->delete();
        DB::table('vehicles_brands')->delete();
        DB::table('vehicles_types')->delete();

        
        
    }
}
