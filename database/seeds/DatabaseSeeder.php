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
        //$this->call(UstadzTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
        // $this->call(PaketsTableSeeder::class);
        //$this->call(SpecialtiesTableSeeder::class);
        // $this->call(TopicsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
