<?php

use Illuminate\Database\Seeder;

class PaketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $jenis_array = ["Konsultasi", "Kursus", "Acara", "Lain-Lain"];
        $pilihan_waktu = ["1.5 jam", "3 jam", "1 bulan", "3 bulan"];
        for($i=0; $i<=sizeof($pilihan_waktu); $i++){
        	DB::table('pakets')
        		->insert([
        			'nama' => $faker->name(),
        			'jenis' => $jenis_array[array_rand($jenis_array, 1)],
        			'harga' => $faker->numberBetween(10000, 300000),
        			'durasi' => $pilihan_waktu[array_rand($pilihan_waktu, 1)]
        		]);
        }
    }
}
