<?php

use Illuminate\Database\Seeder;

class UstadzTableSeeder extends Seeder
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
        $keahlian_array = ["Aqidah", "Fiqh", "Tajwid", "Fisika", "Akhlaq, Adab", "Matematika, Biologi", "Tafsir, Sejarah", "Ekonomi, Sosiologi"];
        $pendidikan_array = ["SD/MI", "SMP/MTs", "SMA/MA", "S1", "S2", "S3", "Lain-lain"];
           for($i=0; $i<=10000; $i++){
            DB::table('ustadzs')
                ->insert([
                    'nama' => $faker->name(),
                    'password' => bcrypt('woy123'),
                    'email' => $faker->unique()->email(),
                    'nama_institusi_pendidikan_terakhir' => $faker->cityPrefix(),
                    'tanggal_lahir' => $faker->date('Y-m-d'),
                    'nomor_ktp' => $faker->unique()->numberBetween(3270000000000000, 3280000000000000),
                    'alasan_bergabung' => $faker->text,
                    'profile_picture' => $faker->url,
                    'jenis_kelamin' => $sex_array[array_rand($sex_array, 1)],
                    'latitude_alamat' => $faker->latitude(-6, -7),
                    'longitude_alamat' => $faker->longitude(106, 107),
                    'status' => $status_array[array_rand($status_array, 1)],
                    'keahlian' => $keahlian_array[array_rand($keahlian_array, 1)], 
                    'pendidikan_terakhir' => $pendidikan_array[array_rand($status_array, 1)],
                    'telepon' => $faker->unique()->numberBetween(62812000000, 62899999999),
                ]);
        }
    }
}
