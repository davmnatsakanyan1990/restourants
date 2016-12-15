<?php

use App\Models\Admin;
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
        $places = Place::all();
        foreach ($places as $place){
            $password = str_random(8);
            $support_id = Place::find($place['id'])->support_id;
            $admin_id = DB::table('admins')->insertGetId([
                'name' => '',
                'email' => '',
                'username' => 'admin'.$support_id,
                'password' => bcrypt($password)
            ]);

            AdminDetails::create(['admin_id' => $admin_id, 'username' => 'admin'.$support_id,  'password' => $password]);

            Place::where('id', $place['id'])->update(['admin_id' => $admin_id]);
        }

    }
}
