<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table()->insert([
            ['name' => 'service 1'],
            ['name' => 'service 2'],
            ['name' => 'service 3'],
            ['name' => 'service 4'],
            ['name' => 'service 5'],
            ['name' => 'service 6'],
        ]);
    }
}
