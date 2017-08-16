<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'type_description' => str_random(60),
        ]);
    }
}
