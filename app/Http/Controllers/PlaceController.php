<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

use App\Http\Requests;

class PlaceController extends Controller
{
    public function show(Request $request){

        $place = Place::with([
            'services',
            'images',
            'rates',
            'shares' => function($share){
                return $share->with('image');
            },
            'comments' => function($comment){
                return $comment->with('user');
            }
            ])
            ->findOrFail(1);

        // get avg rate for current place and push to array
        $collection = collect($place->toArray());
        collect($place->toArray())->each(function($item, $key) use($collection){
            if($key == 'rates'){
                $total_rate = 0;
                $count = count($item);
                foreach ($item as $rate){
                    $total_rate += $rate['mark'];
                }
                $m_rate = round($total_rate/$count);

                $collection->prepend($m_rate, 'rating');
            }
        })->all();

        // get total comments count for current place and add to array
        $collection->prepend(count($collection['comments']), 'comment');

        // format price and add to array
        $collection->prepend('$'.$place->price_from.'-$'.$place->price_to, 'price');

        // format working hours and add to array
        $from = date_create($place->wrk_hrs_from);
        $formated_from = date_format($from,"H:i");

        $to = date_create($place->wrk_hrs_to);
        $formated_to = date_format($to,"H:i");

        $collection->prepend($formated_from.'-'.$formated_to, 'workingHours');
        dd($collection);
    }
}
