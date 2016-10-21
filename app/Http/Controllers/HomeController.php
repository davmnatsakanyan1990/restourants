<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct(){
        
    }

    /**
     * Data for home page
     *
     * @return array
     */
    public function index(){

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

    /**
     * Get average rate for current place
     *
     * @param $place_id
     * @return float|int
     */
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
