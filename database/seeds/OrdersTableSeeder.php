<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_array = App\User::all()->toArray();
        $ustadzs_array = App\Ustadz::all()->toArray();
    	$topics_array = App\Topic::all()->toArray();
    	$pakets_array = App\Paket::all()->toArray();
        $faker = \Faker\Factory::create();

		for($i=0; $i<=1000; $i++){
        	DB::table('orders')
        		->insert([
        			'client_id' => $users_array[array_rand($users_array, 1)]["id"],
        			'server_id' => $ustadzs_array[array_rand($ustadzs_array, 1)]["id"],
        			'paket_id' => $pakets_array[array_rand($pakets_array, 1)]["id"],
        			'topic_id' => $topics_array[array_rand($topics_array, 1)]["id"],
                    'created_at' => $faker->dateTimeBetween('-2 week', 'now', 'Asia/Jakarta'),
                    'updated_at' => $faker->dateTimeBetween('now', 'now', 'Asia/Jakarta')
        		]);
        }
    }
}
