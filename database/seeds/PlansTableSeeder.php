<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
           ['name' => 'Free Trial', 'price' => 0],
           ['name' => 'Standard', 'price' => 29.95],
        ]);
    }
}
