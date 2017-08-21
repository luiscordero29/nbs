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
                'name' => 'luis cordero',
                'email' => 'luis.cordero@webdiv.co',
                'password' => '$2y$10$lJ7fQktXBwrarVxYw4p/Fe.zuCQ8.UdaMDdJZXvV9mZbwkzHU/EB.',
            ]
        );
    }
}
