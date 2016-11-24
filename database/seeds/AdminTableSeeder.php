<?php

use App\Models\AdminDetails;
use App\Models\Place;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = Place::where('admin_id', 1)->get();
        foreach ($places as $place){
            $password = str_random(8);

            $admin_id = DB::table('admins')->insertGetId([
                'name' => '',
                'email' => '',
                'password' => bcrypt($password)
            ]);

            AdminDetails::create(['admin_id' => $admin_id, 'password' => $password]);

            Place::where('id', $place['id'])->update(['admin_id' => $admin_id]);
        }

    }
}
