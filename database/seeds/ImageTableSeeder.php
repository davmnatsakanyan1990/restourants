<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            ['name' => 'image1.jpg', 'imageable_id' => '1', 'imageable_type' => 'App\Models\Place'],
            ['name' => 'image2.jpg', 'imageable_id' => '2', 'imageable_type' => 'App\Models\Place'],
            ['name' => 'image3.jpg', 'imageable_id' => '3', 'imageable_type' => 'App\Models\Place'],
            ['name' => 'image4.jpg', 'imageable_id' => '1', 'imageable_type' => 'App\Models\Place'],
            ['name' => 'image5.jpg', 'imageable_id' => '2', 'imageable_type' => 'App\Models\Place'],
            ['name' => 'image6.jpg', 'imageable_id' => '1', 'imageable_type' => 'App\Models\Share'],
        ]);
    }
}
