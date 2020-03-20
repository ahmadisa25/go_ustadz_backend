<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics_array = ["Aqidah", "Fiqh", "Tajwid", "Tahsin", "Akhlaq", "Tafsir", "Matematika", "Fisika", "Biologi", "Kimia", "Sosiologi", "Ekonomi", "Sejarah", "Bahasa Inggris", "Bahasa Indonesia"];

        for($i = 0; $i<sizeof($topics_array); $i++){
        	DB::table('topics')
        		->insert([
        			'nama' => $topics_array[$i],
        		]);
        }
    }
}
