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
        $this->call(UserTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(PlaceTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(RateTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(PlaceServiceTableSeeder::class);
        $this->call(ShareTableSeeder::class);
    }
}
