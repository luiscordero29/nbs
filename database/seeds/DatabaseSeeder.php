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
            ],
            [
                'name' => 'Juan Cubillos',
                'email' => 'cubillos@webdiv.co',
                'password' => '$2y$10$nlO2oPQStJRqeoD8qobFTOwxV87dUM9ot990vxgJx08hi.q4gxory',
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
