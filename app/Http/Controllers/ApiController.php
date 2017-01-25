<?php

namespace App\Http\Controllers;

use App\Models\AdminDetails;
use App\Models\Category;
use App\Models\City;
use App\Models\Comment;
use App\Models\Cuisin;
use App\Models\Highlight;
use App\Models\Image;
use App\Models\Location;
use App\Models\Place;
use App\Models\PlaceCategory;
use App\Models\PlaceType;
use App\Models\Rate;
use App\Models\Type;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ApiController extends Controller
{

    /**
     * Move downloaded images to the project
     */
    public function movePlaceImages(){
        $images = Image::where('imageable_type', 'App\Models\Place')->where('imageable_id','>',4804)->get()->toArray();

        foreach ($images as $image){
            $exist = File::exists('C:\Users\Designer\Downloads\\'.$image['name']);
            if($exist){
                File::move('C:\Users\Designer\Downloads\\'.$image['name'], 'C:\xampp\htdocs\restourants\public\images\restaurantImages\\'.$image['name']);

            }

        }
    }

    /**
     * Fill place to DB
     *
     * @param Request $request
     */
    public function fillPlace(Request $request){
        $data_json = $request->data;

        $d = json_decode($data_json, true);

        if(count(Place::where('name', $d['name'])->where('mobile', $d['mobile'])->get()->toArray()) == 0) {
            
            $data = array();

            //get location id
            $location_id = Location::where('name', $d['location'])->first()->id;

            // get geo coordinates
            $formatted_address = str_replace(' ', '+', $d['address']);
            // Get cURL resource
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $formatted_address . '&key=' . env('GOOGLE_API_KEY'),
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            if (!curl_exec($curl)) {
                die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
            }
            // Send the request & save response to $resp
            $resp = curl_exec($curl);

            $response = json_decode($resp);
            // Close request to clear up some resources
            curl_close($curl);
            if (count($response->results) > 0) {
                $data['lat'] = $response->results[0]->geometry->location->lat;
                $data['lon'] = $response->results[0]->geometry->location->lng;
            } else {
                $data['lat'] = 0;
                $data['lon'] = 0;
            }

            $cost = count($d['cost']);
            $data['mobile'] = $d['mobile'];
            $data['name'] = $d['name'];
            $data['intro'] = '';
            $data['address'] = $d['address'];
            $data['location_id'] = $location_id;

            $data['site'] = 'site1.com';
            $data['cost'] = $cost;
            $support_id = $this->generateUniqueRandomNumber();
            if($support_id == ''){
                $support_id = $this->generateUniqueRandomNumber();
            }
            $data['support_id'] = $support_id;
            $data['plan_id'] = 1;

            // generate admin
            $password = str_random(8);
            $admin_id = DB::table('admins')->insertGetId([
                'name' => '',
                'email' => '',
                'username' => 'admin'.$support_id,
                'password' => bcrypt($password)
            ]);

            AdminDetails::create(['admin_id' => $admin_id, 'username' => 'admin'.$support_id,  'password' => $password]);

            $data['admin_id'] = $admin_id;

            //fill places table
            $place_id = DB::table('places')->insertGetId(
                $data
            );

            //fill menus
            if (!is_null($d['menus'])) {
                foreach ($d['menus'] as $key => $value) {
                    $menu['name'] = $key;
                    $menu['place_id'] = $place_id;

                    $menu_id = DB::table('menus')->insertGetId($menu);
                    $products = [];

                    foreach ($value as $item) {

                        $item['menu_id'] = $menu_id;
                        array_push($products, $item);

                    }
                    DB::table('products')->insert($products);
                }
            }

            //fill images
            if (count($d['images']) > 0) {
                foreach ($d['images'] as $key => $image) {
                    if ($key == 0) {

                        DB::table('images')->insert([
                            'name' => $image,
                            'imageable_id' => $place_id,
                            'imageable_type' => 'App\Models\Place',
                            'role' => 1
                        ]);
                    } else {
                        DB::table('images')->insert([
                            'name' => $image,
                            'imageable_id' => $place_id,
                            'imageable_type' => 'App\Models\Place'
                        ]);
                    }
                }
            }

            $wk_hours = $d['workinghours'];
            $wk_hours['place_id'] = $place_id;

            // fill working hours
            DB::table('working_hours')->insert($wk_hours);

            //fill highlights_places
            $h = array();
            if (count($d['highlights']) > 0) {
                foreach ($d['highlights'] as $key => $value) {
                    $h[$key]['name'] = $value;
                }

                $highlights = Highlight::whereIn('name', $h)->get()->toArray();
                $high_data = array();
                foreach ($highlights as $key => $value) {
                    $high_data[$key]['place_id'] = $place_id;
                    $high_data[$key]['highlight_id'] = $value['id'];
                }

                DB::table('place_highlights')->insert($high_data);
            }


            //fill comments
            if (count($d['comments']) > 0) {
                $i = 0;
                foreach ($d['comments'] as $comment) {
                    $author = User::create(['name' => $comment['author'], 'email' => time() . $i, 'password' => 'password']);
                    $author_id = $author->id;

                    //Image::create(['name' => $comment['author_image'], 'imageable_id' => $author_id, 'imageable_type' => 'App\User', 'role' => 1]);

                    $comm = Comment::create(['text' => $comment['text'], 'place_id' => $place_id, 'parent_id' => 0, 'user_id' => $author_id,  'created_at' => $comment['date']]);

                    if (!is_null($comment['rate'])) {
                        Rate::create(['user_id' => $author_id, 'place_id' => $place_id, 'mark' => $comment['rate']]);
                    }

                    if (count($comment['sub_comments']) > 0) {
                        foreach ($comment['sub_comments'] as $comment) {
                            $i++;
                            $author = User::create(['name' => $comment['author'], 'email' => time() . $i, 'password' => 'password']);
                            $author_id = $author->id;

                            //Image::create(['name' => $comment['author_image'], 'imageable_id' => $author_id, 'imageable_type' => 'App\User', 'role' => 1]);

                            Comment::create(['text' => $comment['text'], 'place_id' => $place_id, 'parent_id' => $comm->id, 'user_id' => $author_id]);

                        }
                    }
                    $i++;
                }
            }

            //fill place_cuisins
            $c = array();
            if (count($d['cuisines']) > 0) {
                foreach ($d['cuisines'] as $key => $value) {
                    $c[$key]['name'] = $value;
                }
                $cuisins = Cuisin::whereIn('name', $c)->get()->toArray();
                $cuis_data = array();
                foreach ($cuisins as $key => $value) {
                    $cuis_data[$key]['place_id'] = $place_id;
                    $cuis_data[$key]['cuisin_id'] = $value['id'];
                }
                DB::table('place_cuisins')->insert($cuis_data);
            }
        }
    }

    /**
     * Fill all existing cuisines
     * 
     * @param Request $request
     */
    public function fillCuisines(Request $request){

        $d = json_decode($request->data, true);

        foreach ($d as $k => $v) {
            $cuisine['name'] = $v;
            Cuisin::firstOrCreate($cuisine);
        }
    }

    /**
     * Fill locations for current city
     *
     * @param Request $request
     */
    public function fillLocations(Request $request){

        $d = json_decode($request->data, true);
        $city_id = City::firstOrCreate(['name' => $d['city']])->id;
        $location  =array();
        foreach ($d['location'] as $k => $v) {
            $location['name'] = $v;
            $location['city_id'] = $city_id;
            Location::firstOrCreate($location);
        }
    }

    /**
     * Assign category to the places
     * 
     * @param Request $request
     */
    public function assignCategory(Request $request){
        $d = json_decode($request->data, true);

        $category_id = Category::where('name', $d['category'])->first()->id;

        foreach($d['restaurants'] as $restaurant){
            $obj = Place::where('name', $restaurant['name'])->first();

            if($obj){
                $place_id = $obj->id;

                PlaceCategory::firstOrCreate(['place_id' => $place_id, 'category_id' => $category_id ]);
            }
        }
    }

    /**
     * Assign establishment type to the places
     * 
     * @param Request $request
     */
    public function assignType(Request $request){
        $d = json_decode($request->data, true);

        $type_id = Type::where('name', $d['type'])->first()->id;

        foreach($d['restaurants'] as $restaurant){
            $obj = Place::where('name', $restaurant['name'])->first();

            if($obj){
                $place_id = $obj->id;

                PlaceType::firstOrCreate(['place_id' => $place_id, 'type_id' => $type_id ]);
            }
        }
    }

    /**
     * Generate unique support ID
     */
    public function fillSupportId(){
        $places = Place::withTrashed()->whereNull('support_id')->get()->toArray();

        foreach ($places as $place){
            $support_id = $this->generateUniqueRandomNumber();
            Place::withTrashed()->where('id', $place['id'])->update(['support_id' => $support_id]);
        }
        
        echo 'All numbers have generated';
    }

    public function generateUniqueRandomNumber(){
        $number = rand(100000, 999999);

        $item = Place::where('support_id', $number)->get()->toArray();

        if(count($item) > 0){
            $this->generateUniqueRandomNumber();
        }
        else{
            return $number;
        }

    }

    /**
     * Generate csv file wit places which has email
     */
    public function exportPlaces(){
        $places = DB::table('places')
            ->join('admin_details', 'places.admin_id', '=', 'admin_details.admin_id')
            ->leftJoin('locations', 'places.location_id', '=', 'locations.id')
            ->leftJoin('cities', 'locations.city_id', '=', 'cities.id')
            ->whereNotNull('email')
            ->select(
                'places.id',
                'places.email',
                'places.name',
                'admin_details.username',
                'admin_details.password',
                'places.support_id',
                'cities.name as city_name'
            )
            ->get();
        $data = array();
        foreach($places as $place){
            $d = array();
            $d['Email Address'] = $place->email;
            $d['Name'] = $place->name;
            $d['Your URL'] = 'https://restadviser.com/#/'.$place->city_name.'/'.$place->name.'/'.$place->id;
            $d['Username:'] = $place->username;
            $d['Password:'] = $place->password;
            $d['Your Support PIN:'] = $place->support_id;
            array_push($data, $d);
        }

        Excel::create('Restaurants_Details', function($excel) use ($data){

            $excel->sheet('Details', function($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->download('csv');
    }

    /**
     * Generate Admins
     */
    public function fillAdmins(){
        $places = Place::whereNull('admin_id')->get()->toArray();
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
