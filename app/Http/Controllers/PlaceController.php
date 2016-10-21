<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Http\Requests;

class PlaceController extends Controller
{
    public function show($id){

        $place = Place::with([
            'highlights',
            'images',
            'rates',
            'workinghour',
            'shares' => function($share){
                return $share->with('image');
            },
            'comments' => function($comment){
                return $comment->with(['user' => function($user){
                    return $user->with(['rates' => function($rate){
                       return $rate->where('place_id', 1);
                    }]);
                }]);
            },
            'menus' => function($menu){
                return $menu->with('products');
            }
            ])
            ->findOrFail($id);

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
        switch ($place->cost){
            case 0:
                $collection->prepend('', 'price');
                break;
            case 1:
                $collection->prepend('$', 'price');
                break;
            case 2:
                $collection->prepend('$$', 'price');
                break;
            case 3:
                $collection->prepend('$$$', 'price');
                break;
            case 4:
                $collection->prepend('$$$$', 'price');
                break;
        }

        $wrk_hs_array = $place->workinghour->toArray();

        $workinghours = array();

        $workinghours['mon'] = $wrk_hs_array['mon'];
        $workinghours['tue'] = $wrk_hs_array['tue'];
        $workinghours['wed'] = $wrk_hs_array['wed'];
        $workinghours['thu'] = $wrk_hs_array['thu'];
        $workinghours['fri'] = $wrk_hs_array['fri'];
        $workinghours['sat'] = $wrk_hs_array['sat'];
        $workinghours['sun'] = $wrk_hs_array['sun'];


        $collection->prepend($workinghours, 'workingHours');

        // format shares, comments
        $array = $collection->all();

        $data = array();

        foreach ($array as $key=>$value){

//            // share format
//            if($key == 'shares'){
//                foreach ($array[$key] as $k=>$v){
//
//                    $data[$key][$k]['photo'] =  $v['image']['name'];
//
//                    $from = date_create($v['wrk_hrs_from']);
//                    $formatted_from = date_format($from, "H:i");
//
//                    $to = date_create($v['wrk_hrs_to']);
//                    $formatted_to = date_format($to, "H:i");
//                    $data[$key][$k]['workingHours'] =  'Working hours: '.$formatted_from.'- '.$formatted_to;
//                    $data[$key][$k]['title'] = $v['title'];
//                    $data[$key][$k]['content'] = $v['content'];
//                    $data[$key][$k]['location'] = $v['location'];
//                }
//            }

            //comments format
            if($key == 'comments'){
                foreach ($array[$key] as $k=>$v){
                    if(count(($v['user']['rates'])) > 0) {
                        $data[$key][$k]['rate'] = $v['user']['rates'][0]['mark'];
                    }
                    else{
                        $data[$key][$k]['rate'] = 0;
                    }

                    $data[$key][$k]['name'] = $v['user']['name'];
                    $data[$key][$k]['date'] = date_format(date_create($array[$key][$k]['created_at']), "m/d/y");
                    $data[$key][$k]['comment'] = $v['text'];
                }
            }

            // images format
            if($key == 'images'){
                $images = array();
                foreach ($array[$key] as $k => $v){
                    array_push($images, '../images/restaurantImages/'.$v['name']);
                }
                $data['images'] = $images;
            }

            // menus format
            if($key == 'menus'){
                foreach ($array[$key] as $k=>$v){
                    $data['menuItems'][$k] = $v['name'];
                }
            }
        }

        $data['mobileNumber'] = $array['mobile'];
        $data['name'] = $array['name'];
        $data['rating'] = (int)$array['rating'];
        $data['comment'] = $array['comment'];
        $data['intro'] = $array['intro'];
        $data['address'] = $array['address'];
        $data['site'] = $array['site'];
        $data['price'] = $array['price'];
        $data['workingHours'] = $array['workingHours'];

       // $data['shareItems'] = $data['shares'];
        dd($data);
        return response()->json($data);
    }
    
    
}
