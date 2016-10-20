<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct(){
        
    }
    
    public function index(){

//        format intro, create explane and add to array
//        $explane = implode(' ', array_slice(explode(' ', $place->intro), 0, 10));
//        $collection->prepend($explane, 'explane');
        
        $places = array();

        $data = Place::with('thumb_image', 'highlights')->get();

        foreach ($data->toArray() as $item){
            $place = array();
            $rate = $this->avg_rate($item['id']);
            $place['rating'] = $rate;
            $place['id'] = $item['id'];
            $place['title'] = $item['name'];
            $place['explane'] = $item['intro'];
            $place['address'] = $item['address'];
            $place['image'] = $item['thumb_image'][0]['name'];

            $hs = array();
            foreach ($item['highlights'] as $key => $highlight){
                array_push($hs, $highlight['name']);
            }
            $place['service'] = $hs;

            array_push($places, $place);

        }

        return $places;

    }

    public function avg_rate($place_id){
        $rates = DB::table('rates')->where('place_id', $place_id)->select('mark')->get();
        $sum = 0;
        foreach ($rates as $rate){
            $sum = $sum + $rate->mark;
        }
        if(count($rates) > 0)
            return $sum/count($rates);
        else
            return 0;
    }

}
