<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('super_admins')->insert([
            'name' => 'Super Admin',
            'username' => 'admin',
            'password' => bcrypt('@admin10')
        ]);
    }
}
