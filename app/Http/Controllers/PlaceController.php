<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Place;
use App\Http\Requests;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{

    /**
     * Get all restaurants for given city
     *
     * @return array
     */
    public function index(){
        $city = request('city');
        $page = request('page');
        $places = array();

        $result = array();
        $d = Place::with(['thumb_image', 'highlights', 'location' => function($location) use ($city){
            $location->with(['city' => function($query) use ($city){
                return $query->where('name', $city);
            }]);
        }])->get();

        $data = $d->filter(function ($value, $key) {
            return $value->location->city != null;
        })->values()->chunk(10)->toArray();


        foreach ($data[$page-1] as $item){
            $place = array();
            $rate = $this->avg_rate($item['id']);
            $place['rating'] = $rate;
            $place['id'] = $item['id'];
            $place['title'] = $item['name'];
            $place['explane'] = $item['intro'];
            $place['address'] = $item['address'];
            $place['lat'] = $item['lat'];
            $place['long'] = $item['lon'];
            $place['image'] = $item['thumb_image'][0]['name'];

            $hs = array();
            foreach ($item['highlights'] as $key => $highlight){
                array_push($hs, $highlight['name']);
            }
            $place['service'] = $hs;

            array_push($places, $place);
        }

        $result['restaurants'] = $places;
        $result['city'] = $city;
        if($page == count($data)){
            $result['status'] = 'ended';
        }

        return $result;
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

    /**
     * Show current restaurants
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id){

        $place = Place::with([
            'highlights',
            'images',
            'rates',
            'workinghour',
            'cuisins',
            'highlights',
            'types',
            'shares' => function($share){
                return $share->with('image');
            },
            'comments',
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
                if($count != 0 )
                    $m_rate = round($total_rate/$count);
                else
                    $m_rate = 0;

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

        //get comments author
        $comments = $array['comments'];
        foreach($comments as $key => $comment){
            $comments[$key]['author'] = $comment['commentable_type'] :: find($comment['commentable_id'])->toArray();
            $sub_comments = Comment::where('parent_id', $comment['id'])->orderBy('created_at', 'asc')->get()->toArray();


            foreach ($sub_comments as $k=>$sub_comment){
                $sub_comments[$k]['author'] = $sub_comment['commentable_type'] :: find($sub_comment['commentable_id'])->toArray();
            }
            $comments[$key]['sub_comments'] = $sub_comments;
        }

        $array['comments'] = $comments;

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

//            comments format
            if($key == 'comments'){
                foreach ($array[$key] as $k=>$v){
//                    if(count(($v['user']['rates'])) > 0) {
//                        $data[$key][$k]['rate'] = $v['user']['rates'][0]['mark'];
//                    }
//                    else{
//                        $data[$key][$k]['rate'] = 0;
//                    }

                    $data[$key][$k]['name'] = $v['author']['name'];
                    $data[$key][$k]['date'] = date_format(date_create($array[$key][$k]['created_at']), "m/d/y");
                    $data[$key][$k]['comment'] = $v['text'];
                    $data[$key][$k]['id'] = $v['id'];

                }
            }

            // cuisins format
            if($key == 'cuisins'){
                $cuisins = array();
                foreach ($array[$key] as $k=>$v){
                    array_push($cuisins, $v['name']);
                }
                $data['cuisins'] = $cuisins;
            }

            // services format
            if($key == 'highlights'){
                $services = array();
                foreach ($array[$key] as $k=>$v){
                    array_push($services, $v['name']);
                }
                $data['services'] = $services;
            }

            //types format
            if($key == 'types'){
                $types = array();
                foreach ($array[$key] as $k=>$v){
                    array_push($types, $v['name']);
                }
                $data['types'] = $types;
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
                    $data['menuItems'][$k]['name'] = $v['name'];
                    $data['menuItems'][$k]['id'] = $v['id'];
                }
            }
        }

        $data['id'] = $array['id'];
        $data['mobileNumber'] = $array['mobile'];
        $data['name'] = $array['name'];
        $data['rating'] = (int)$array['rating'];
        $data['comment'] = $array['comment'];
        $data['intro'] = $array['intro'];
        $data['address'] = $array['address'];
        $data['lat'] = $array['lat'];
        $data['long'] = $array['lon'];
        $data['site'] = $array['site'];
        $data['price'] = $array['price'];
        $data['workingHours'] = $array['workingHours'];

       // $data['shareItems'] = $data['shares'];

        return response()->json($data);
    }

    public function products($menu_id){
       $products = Product::where('menu_id', $menu_id)->select(['title', 'description', 'price'])->get()->toArray();
        return $products;
    }
    
    
}
