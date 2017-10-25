<?php
use Illuminate\Support\Facades\DB;
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
        $this->call(UsersTableSeeder::class); 
        
        $this->call(UsersTypesTableSeeder::class); 
        
        /*
        $this->call(VehiclesTypesTableSeeder::class); 
        $this->call(VehiclesTableSeeder::class); 

        $this->call(UsersDivisionsTableSeeder::class); 
        $this->call(UsersPositionsTableSeeder::class); 
        
        $this->call(VehiclesBrandsTableSeeder::class); 
        $this->call(VehiclesModelsTableSeeder::class); 
        $this->call(VehiclesColorsTableSeeder::class); 

        $this->call(ParkingsSectionsTableSeeder::class); 
        $this->call(ParkingsDimensionsTableSeeder::class); 
        $this->call(ParkingsTableSeeder::class); */
    }
}
