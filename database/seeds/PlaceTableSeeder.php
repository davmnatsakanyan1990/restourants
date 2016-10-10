<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert([
            ['mobile' => '+(222) 1212145454', 'name' => 'Restourant 1', 'intro' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit Aliquid aperiam aspernatur debitis deserunt dicta earum error hic illum in labore nostrum officiis reprehenderit sed, similique tenetur totam unde veniam voluptate Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam aspernatur debitis deserunt dicta earum error hic illum in labore nostrum officiis reprehenderit sed', 'address' => 'address 1', 'lat' => '41.8819', 'lon' => '-87.6278', 'site' => 'site1.com', 'price_from' => '150', 'price_to' => '1500', 'wrk_hrs_from' => '12:00:00', 'wrk_hrs_to' => '21:00:00'],
            ['mobile' => '+(222) 1212145454', 'name' => 'Restourant 2', 'intro' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit Aliquid aperiam aspernatur debitis deserunt dicta earum error hic illum in labore nostrum officiis reprehenderit sed, similique tenetur totam unde veniam voluptate Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam aspernatur debitis deserunt dicta earum error hic illum in labore nostrum officiis reprehenderit sed', 'address' => 'address 2', 'lat' => '45.8819', 'lon' => '-82.6278', 'site' => 'site2.com', 'price_from' => '550', 'price_to' => '4500', 'wrk_hrs_from' => '12:00:00', 'wrk_hrs_to' => '21:00:00'],
            ['mobile' => '+(222) 1212145454', 'name' => 'Restourant 3', 'intro' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit Aliquid aperiam aspernatur debitis deserunt dicta earum error hic illum in labore nostrum officiis reprehenderit sed, similique tenetur totam unde veniam voluptate Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam aspernatur debitis deserunt dicta earum error hic illum in labore nostrum officiis reprehenderit sed', 'address' => 'address 3', 'lat' => '51.8819', 'lon' => '-89.6278', 'site' => 'site3.com', 'price_from' => '50', 'price_to' => '2500', 'wrk_hrs_from' => '12:00:00', 'wrk_hrs_to' => '21:00:00'],
        ]);
    }
}
