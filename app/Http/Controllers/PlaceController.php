<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Comment;
use App\Models\Location;
use App\Models\Place;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Cuisin;
use App\Models\Highlight;

class PlaceController extends Controller
{

    /**
     * Get all restaurants for given city
     *
     * @return array
     */
    public function index($city){

        $count = request('page')*10;
        if(request('q')){
            $data = $this->getRestaurants($city, $count, null, request('q'));
        }
        else{
            $data = $this->getRestaurants($city, $count);
        }

        $result['noMoreData'] = $data['noMoreData'];
        $result['restaurants'] = $data['restaurants'];
        $result['city'] = $city;
        $result['filters'] = $this->getFilters($city);

        return $result;
    }

    /**
     * Get next 10 places
     *
     * @param $city
     * @return mixed
     */
    public function loadMore($city){
        //TODO 
        $filter_data = json_decode(request('filters'), true);
        $page = request('page');
        $count = $page*10;
        $filters = $this->createFilters($filter_data);

        if(count($filters['categories']) > 0 || count($filters['costs']) > 0 || count($filters['highlights']) > 0 || count($filters['cuisines']) > 0 || count($filters['types']) > 0 || count($filters['locations']) > 0) {

            $data = $this->getRestaurants($city, $count, $filters);
        }
        else{
            $data = $this->getRestaurants($city, $count);
        }
        
        $result['restaurants'] = $data['restaurants'];

        if( $data['noMoreData']){
            $result['status'] = 'ended';
        }

        return $result;
    }

    /**
     * @param $data
     * @return array
     */
    public function createFilters($data){
        $filters = array();
        $filters['categories'] = array_key_exists('Mode', $data) ? $data['Mode'] : [];
        $filters['costs'] = array_key_exists('Cost', $data) ? $data['Cost'] : [];
        $filters['highlights'] = array_key_exists('Sort By', $data) ? $data['Sort By'] : [];
        $filters['cuisines'] = array_key_exists('Cuisine', $data) ? $data['Cuisine'] : [];
        $filters['types'] = array_key_exists('Type', $data) ? $data['Type'] : [];
        $filters['locations'] = array_key_exists('Location', $data) ? $data['Location'] : [];
        
        return $filters;
    }

    /**
     * Get filtered places, for given filters
     *
     * @param $city
     * @return array
     */
    public function filter($city){
        $page = request('page');
        $count = $page*10;
        $filter_data = json_decode(request('filters'), true);

        $filters = $this->createFilters($filter_data);

        $data = $this->getRestaurants($city, $count, $filters);

        $result['restaurants'] = $data['restaurants'];

        if( $data['noMoreData']){
            $result['status'] = 'ended';
        }

        return $result;

    }
    
    public function getCategoryProducts($data){
        $d = json_decode($data, true);
        $page = $d['page'];
        $count = $page*10;
        $city = request('city');

        $cat_name = $d['filters']['Mode'];
        $cate_id = Category::where('name', $cat_name)->first()->id;
        $d['filters']['Mode'] = [$cate_id];

        $filters = $this->createFilters($d['filters']);

        $data = $this->getRestaurants($city, $count, $filters);

        $result['restaurants'] = $data['restaurants'];

        if( $data['noMoreData']){
            $result['status'] = 'ended';
        }

        $result['filters'] = $this->getFilters($city);
        
        return $result;
    }


    /**
     * @param string $city
     * @param integer $count
     * @param null array $filters
     * @param null string $q
     * @return mixed
     */
    public function getRestaurants($city, $count, $filters = null, $q = null){

        //get filter data
        if($filters) {
            $categories = $filters['categories'];
            $costs = $filters['costs'];
            $highlights = $filters['highlights'];
            $cuisines = $filters['cuisines'];
            $types = $filters['types'];
            $locations = $filters['locations'];
        }
        else{
            $categories = [];
            $costs = [];
            $highlights = [];
            $cuisines = [];
            $types = [];
            $locations = [];
        }

        $data = Place::with(['categories', 'highlights', 'cuisins', 'types', 'thumb_image']);

        if(count($locations) > 0)
            $data = $data->orWhereIn('location_id', $locations);

        if(count($costs) > 0)
            $data = $data->orWhereIn('cost', $costs);

        if(count($categories) > 0) {
            $data = $data->orWhereHas('categories', function ($query) use ($categories) {
                $query->whereIn('category_id', $categories);
            });
        }

        if(count($highlights) > 0) {
            $data = $data->orWhereHas('highlights', function ($query) use ($highlights) {
                $query->whereIn('highlight_id', $highlights);
            });
        }

        if(count($cuisines) > 0) {
            $data = $data->orWhereHas('cuisins', function ($query) use ($cuisines) {
                $query->whereIn('cuisin_id', $cuisines);
            });
        }

        if(count($types) > 0) {
            $data = $data->orWhereHas('types', function ($query) use ($types) {
                $query->whereIn('type_id', $types);
            });
        }

        // filter by city
        $city_id = City::where('name', $city)->first()->id;
        $city_locations = Location::where('city_id', $city_id)->lists('id')->toArray();
        $data = $data->whereIn('location_id', $city_locations);

        if($data->count() > $count){
            $noMoreData = false;
        }
        else{
            $noMoreData = true;
        }

        $places = $data->limit($count)->get()->toArray();

        //format data
        $restaurants = array();
        if(count($places) > 0) {
            foreach ($places as $item) {
                $place = array();
                $rate = $this->avg_rate($item['id']);
                $place['rating'] = $rate;
                $place['id'] = $item['id'];
                $place['title'] = $item['name'];
                $place['explane'] = $item['intro'];
                $place['address'] = $item['address'];
                $place['lat'] = $item['lat'];
                $place['long'] = $item['lon'];

                if (count($item['thumb_image']) > 0)
                    $place['image'] = $item['thumb_image'][0]['name'];
                else
                    $place['image'] = null;

                $hs = array();
                foreach ($item['highlights'] as $key => $highlight) {
                    array_push($hs, $highlight['name']);
                }
                $place['service'] = $hs;

                $place['last_comment'] = $this->getLastComment($item['id']);

                array_push($restaurants, $place);
            }
        }
        else{
            $restaurants = [];
        }
        $response['restaurants'] = $restaurants;
        $response['noMoreData']  = $noMoreData;

        return $response;
    }

    public function getLastComment($place_id){
        $place_comments = Place::find($place_id)->comments()->where('parent_id', 0)->get()->toArray();
        foreach($place_comments as $comment){
            if(strlen($comment['text']) > 120){
                return str_limit($comment['text'], 120);
            }
        }
    }

    /**
     * Get all filters
     *
     * @return array
     */
    public function getFilters($city){
        $data = [];
        $data['Mode'] = Category::select('id', 'name')->get()->toArray();
        $data['Sort By'] = Highlight::select('id', 'name')->get()->toArray();
        $data['Cuisine'] = Cuisin::select('id', 'name')->get()->toArray();
        $data['Type Of Restaurants'] = Type::select('id', 'name')->get()->toArray();

        $c = City::where('name', $city)->first();
        if($c)
            $data['Location'] = Location::where('city_id', $c->id)->select('id', 'name')->get()->toArray();
        else
            $data['Location'] = [];
        return $data;

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
            'comments' => function($comments){
                return $comments->orderBy('created_at', 'desc');
            },
            'menus' => function($menu){
                return $menu->with('products');
            }
        ])
            ->findOrFail($id);

        // get avg rate for current place and push to array
        $collection = collect($place->toArray());
        collect($place->toArray())->each(function($item, $key) use($collection){

            switch ($key){
                case 'rates':
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
                    break;
//                case 'images':
//                    $i = 0;
//                    $cover_images = [];
//                    foreach($item as $image){
//                        $image_size = getimagesize(url('/images/restaurantImages/'.$image['name']));
//                        if(($image_size[0]/$image_size[1]) > 2 && ($image_size[0]/$image_size[1]) < 3 && $i < 3){
//                            $cover_images[$i] = $image['name'];
//                            $i++;
//                        }
//                    }
//
//                    $collection->prepend($cover_images, 'cover_images');
//                    break;
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
        if(count($array['comments']) > 0){
            $comments = $array['comments'];
            foreach ($comments as $key => $comment) {
                $comments[$key]['author'] = $comment['commentable_type']:: find($comment['commentable_id'])->toArray();
                $sub_comments = Comment::where('parent_id', $comment['id'])->orderBy('created_at', 'asc')->get()->toArray();


                foreach ($sub_comments as $k => $sub_comment) {
                    $sub_comments[$k]['author'] = $sub_comment['commentable_type']:: find($sub_comment['commentable_id'])->toArray();
                }
                $comments[$key]['sub_comments'] = $sub_comments;
            }


            $chunked = collect($comments)->values()->chunk(5)->toArray();
            $comm_pages = count($chunked);
            $array['comments'] = $chunked[0];
        }
        $data = array();

        foreach ($array as $key=>$value){

            //comments format
            if(count($array['comments']) > 0){
                if ($key == 'comments') {
                    foreach ($array[$key] as $k => $v) {

                        $data[$key][$k]['name'] = $v['author']['name'];
                        $data[$key][$k]['date'] = date_format(date_create($array[$key][$k]['created_at']), "m/d/y");
                        $data[$key][$k]['comment'] = $v['text'];
                        $data[$key][$k]['id'] = $v['id'];

                        $sub_coms = Comment::where('parent_id', $v['id'])->get()->toArray();
                        if (count($sub_coms) > 0) {
                            foreach ($sub_coms as $index => $comment) {
                                $author = $comment['commentable_type']:: find($comment['commentable_id'])->name;
                                $data[$key][$k]['subComment'][$index]['name'] = $author;
                                $data[$key][$k]['subComment'][$index]['comment'] = $comment['text'];
                                $data[$key][$k]['subComment'][$index]['date'] = date_format(date_create($comment['created_at']), "m/d/y");
                                $data[$key][$k]['subComment'][$index]['id'] = $comment['id'];
                            }
                        } else {
                            $data[$key][$k]['subComment'] = null;
                        }
                    }
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
        if(isset($comm_pages) && $comm_pages == 1)
            $data['more_comments'] = false;
        else
            $data['more_comments'] = true;
        $data['intro'] = $array['intro'];
        $data['address'] = $array['address'];
        $data['lat'] = $array['lat'];
        $data['long'] = $array['lon'];
        $data['site'] = $array['site'];
        $data['price'] = $array['price'];
        $data['workingHours'] = $array['workingHours'];
        
        $collection = collect(config('coverimages'));
        $random = $collection->random(3)->toArray();
        $data['coverImages'] = $random;

        // $data['shareItems'] = $data['shares'];

        return response()->json($data);
    }

    /**
     * get more comments
     *
     * @return mixed
     */
    public function moreComments(){
        $place_id = request('place_id');
        $page = request('page');

        $place = Place::with(['comments' => function($comments){
            return $comments->orderBy('created_at', 'desc');
        }])
        ->findOrFail($place_id);

        $collection = collect($place->toArray());

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
        $chunked = collect($comments)->values()->chunk(5)->toArray();
        $pages = count($chunked);
        $array['comments'] = $chunked[$page-1];

        $response = array();
        $comms = array();
        foreach ($array['comments'] as $k=>$v){

            $comms[$k]['name'] = $v['author']['name'];
            $comms[$k]['date'] = date_format(date_create($v['created_at']), "m/d/y");
            $comms[$k]['comment'] = $v['text'];
            $comms[$k]['id'] = $v['id'];

            $sub_coms = Comment::where('parent_id', $v['id'])->get()->toArray();
            if(count($sub_coms) > 0) {
                foreach ($sub_coms as $index => $comment) {
                    $author = $comment['commentable_type']:: find($comment['commentable_id'])->name;
                    $comms[$k]['subComment'][$index]['name'] = $author;
                    $comms[$k]['subComment'][$index]['comment'] = $comment['text'];
                    $comms[$k]['subComment'][$index]['date'] = date_format(date_create($comment['created_at']), "m/d/y");
                    $comms[$k]['subComment'][$index]['id'] = $comment['id'];
                }
            }
            else{
                $comms[$k]['subComment'] = null;
            }
        }

        $response['comments'] = $comms;
        if($page == $pages)
            $response['more_data'] = false;
        else
            $response['more_data'] = true;
        return $response;
    }
    
    /**
     * get products for given menu
     * @param $menu_id
     * @return mixed
     */
    public function products($menu_id){
        $products = Product::where('menu_id', $menu_id)->select(['title', 'description', 'price'])->get()->toArray();
        return $products;
    }

    /**
     * get places by search
     *
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request){

        $city_locations = Location::where('city_id', $request->id)->lists('id')->toArray();

        $places = Place::whereIn('location_id', $city_locations)->where('name', 'like', '%'.$request->value.'%')->select(['id', 'name', 'address'])->get()->toArray();

        return $places;
    }


}
