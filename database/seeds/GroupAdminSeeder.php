<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_admins')->insert([
            [
                'name' => 'admin1',
                'username' => 'admin1',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'admin2',
                'username' => 'admin2',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'admin3',
                'username' => 'admin3',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'admin4',
                'username' => 'admin4',
                'password' => bcrypt('123456')
            ]
        ]);
    }
}
