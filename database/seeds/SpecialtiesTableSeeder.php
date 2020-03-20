<?php

use App\Ustadz;
use App\Topic;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = \Faker\Factory::create();
    	$user_array = Ustadz::all()->toArray();
    	$topics_array = Topic::all()->toArray();
        for($i=0; $i<=10000; $i++){
        	DB::table('specialties')
        		->insert([
        			'user_id' => $user_array[array_rand($user_array, 1)]["id"],
        			'topic_id' =>$topics_array[array_rand($topics_array, 1)]["id"],
        		]);
        }
    }
}
