<?php
use App\Rewards;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Webpatser\Uuid\Uuid;


class RewardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        Rewards::truncate();     
	    for ($i=0; $i < 100; $i++) { 
	    	$reward = new Rewards;
	        $reward->reward_name = $faker->unique()->realText($faker->numberBetween(10,60));
	        $reward->reward_ammount = $faker->numberBetween(1,999);
	        $reward->reward_description = $faker->unique()->realText();
	        $reward->reward_uid  = Uuid::generate()->string;
	        $reward->save();
	    }
    }
}
