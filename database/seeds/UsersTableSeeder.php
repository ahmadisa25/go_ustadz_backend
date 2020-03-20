<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $sex_array = ["P", "W"];
        $status_array = ["lajang", "menikah", "duda", "janda"];

        for($i=0; $i<=10000; $i++){
        	DB::table('users')
        		->insert([
        			'nama' => $faker->name(),
        			'password' => bcrypt('woy123'),
        			'email' => $faker->unique()->email(),
        			'tanggal_lahir' => $faker->date('Y-m-d'),
        			'pekerjaan' => $faker->name(),
        			'nomor_ktp' => $faker->unique()->numberBetween(3270000000000000, 3280000000000000),
        			'alasan_bergabung' => $faker->text,
        			'profile_picture' => $faker->url,
        			'jenis_kelamin' => $sex_array[array_rand($sex_array, 1)],
        			'latitude_alamat' => $faker->latitude(-6, -7),
        			'longitude_alamat' => $faker->longitude(106, 107),
        			'status' => $status_array[array_rand($status_array, 1)],
        			'telepon' => $faker->unique()->numberBetween(62812000000, 62899999999),
        		]);
        }
    }
}
