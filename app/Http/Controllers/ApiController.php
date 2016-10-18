<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Cuisin;
use App\Models\Highlight;
use App\Models\Image;
use App\Models\Location;
use App\Models\Place;
use App\Models\PlaceCategory;
use App\Models\PlaceType;
use App\Models\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ApiController extends Controller
{

    public function movePlaceImages(){
        $images = Image::where('imageable_type', 'App\Models\Place')->get()->toArray();
        foreach ($images as $image){
            $exist = File::exists('C:\Users\Designer\Downloads\\'.$image['name']);
            if($exist){
                File::move('C:\Users\Designer\Downloads\\'.$image['name'], 'C:\xampp\htdocs\restourants\public\images\restaurantImages\\'.$image['name']);

            }

        }
    }

    public function fillplaces(Request $request){
        $data_json = $request->data;

        $d = json_decode($data_json, true);
        $data = array();

        foreach ($d as $k=>$v){

            //get location id
            $location_id = Location::where('name', $v['location'])->first()->id;

            $cost = count($v['cost']);
            $data['mobile'] = $v['mobile'];
            $data['name'] = $v['name'];
            $data['intro'] = ' dfdf';
            $data['address'] = $v['address'];
            $data['location_id'] = $location_id;
            $data['lat'] = '41.8819';
            $data['lon'] = '-87.6278';
            $data['site'] = 'site1.com';
            $data['cost'] = $cost;


            //fill places table
            $place_id = DB::table('places')->insertGetId(
                $data
            );

            //fill images
            foreach($v['images'] as $image) {

                DB::table('images')->insert([
                    'name' => $image,
                    'imageable_id' => $place_id,
                    'imageable_type' => 'App\Models\Place'
                ]);
            }

            $wk_hours = $v['workinghours'];
            $wk_hours['place_id'] = $place_id;

            // fill working hours
            DB::table('working_hours')->insert($wk_hours);

            //fill highlights_places

            $h = array();
            foreach ($v['highlights'] as $key=>$value){
                $h[$key]['name'] = $value;
            }

            $highlights = Highlight::whereIn('name', $h)->get()->toArray();
            $high_data = array();
            foreach ($highlights as $key=>$value){
                $high_data[$key]['place_id'] = $place_id;
                $high_data[$key]['highlight_id'] = $value['id'];
            }

            DB::table('place_highlights')->insert($high_data);

            //fill place_cuisins

            $c = array();
            foreach ($v['cuisines'] as $key=>$value){
                $c[$key]['name'] = $value;
            }

            $cuisins = Cuisin::whereIn('name', $c)->get()->toArray();
            $cuis_data = array();
            foreach ($cuisins as $key=>$value){
                $cuis_data[$key]['place_id'] = $place_id;
                $cuis_data[$key]['cuisin_id'] = $value['id'];
            }
            DB::table('place_cuisins')->insert($cuis_data);

        };
    }

    public function fillCuisines(Request $request){

        $d = json_decode($request->data, true);

        foreach ($d as $k => $v) {
            $cuisine['name'] = $v;
            Cuisin::firstOrCreate($cuisine);
        }
    }

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
}
