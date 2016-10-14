<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Cuisin;
use App\Models\Highlight;
use App\Models\Place;
use App\WorkingHour;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    public function show($id){

        $place = Place::with([
            'services',
            'images',
            'rates',
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
        $collection->prepend('$'.$place->price_from.'-$'.$place->price_to, 'price');

        // format working hours and add to array
        $from = date_create($place->wrk_hrs_from);
        $formated_from = date_format($from,"H:i");

        $to = date_create($place->wrk_hrs_to);
        $formated_to = date_format($to,"H:i");

        $collection->prepend($formated_from.'-'.$formated_to, 'workingHours');

        // format shares, comments
        $array = $collection->all();

        $data = array();

        foreach ($array as $key=>$value){

            // share format
            if($key == 'shares'){
                foreach ($array[$key] as $k=>$v){

                    $data[$key][$k]['photo'] =  $v['image']['name'];

                    $from = date_create($v['wrk_hrs_from']);
                    $formatted_from = date_format($from, "H:i");

                    $to = date_create($v['wrk_hrs_to']);
                    $formatted_to = date_format($to, "H:i");
                    $data[$key][$k]['workingHours'] =  'Working hours: '.$formatted_from.'- '.$formatted_to;
                    $data[$key][$k]['title'] = $v['title'];
                    $data[$key][$k]['content'] = $v['content'];
                    $data[$key][$k]['location'] = $v['location'];
                }
            }

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
        $data['shareItems'] = $data['shares'];
        
        return response()->json($data);
    }
    
    public function fillplaces(Request $request){
//        $data_json = '{"0":{"workinghours":{"Mon":"11 AM to 12 Midnight","Tue":"11 AM to 12 Midnight","Wed":"11 AM to 12 Midnight","Thu":"11 AM to 12 Midnight","Fri":"11 AM to 1 AM","Sat":"10 AM to 1 AM","Sun":"10 AM to 12 Midnight"},"name":"Squatters Pub Brewery","mobile":"(801) 363-2739","address":"147 W Broadway, Salt Lake City UT  84101","cuisines":{"0":"American","1":"Burger","2":"Bar Food"},"cost":{},"location":"Downtown","highlights":{"0":"Takeout Available","1":"Full Bar Available","2":"Outdoor Seating","3":"Private Dining Area Available","4":"Gluten Free Options","5":"Nightlife"}},"1":{"workinghours":{"Mon":"10 AM to 8 PM","Tue":"10 AM to 8 PM","Wed":"10 AM to 8 PM","Thu":"10 AM to 8 PM","Fri":"10 AM to 8 PM","Sat":"10 AM to 8 PM","Sun":"Closed"},"name":"Sixth & Pine","mobile":"(801) 384-4933","address":"55 SW Temple, Salt Lake City UT  84101","cuisines":{"0":"American","1":"Diner"},"cost":{"0":"$","1":"$"},"location":"Downtown","highlights":{"0":"Delivery","1":"Takeout Available","2":"Wifi","3":"Kid Friendly","4":"Gluten Free Options"}},"2":{"workinghours":{"Mon":"11 AM to 3 PM","Tue":"11 AM to 3 PM, 5 PM to 10 PM","Wed":"11 AM to 3 PM, 5 PM to 10 PM","Thu":"11 AM to 3 PM, 5 PM to 10 PM","Fri":"11 AM to 3 PM, 5 PM to 10:30 PM","Sat":"5 PM to 10:30 PM","Sun":"Closed"},"name":"From Scratch","mobile":"(801) 961-9000","address":"62 East Gallivan Ave, Salt Lake City UT  84111","cuisines":{"0":"American","1":"Italian","2":"Pizza"},"cost":{"0":"$","1":"$","2":"$"},"location":"Downtown","highlights":{"0":"Delivery","1":"Takeout Available"}},"3":{"workinghours":{"Mon":"11 AM to 10 PM","Tue":"11 AM to 10 PM","Wed":"11 AM to 10 PM","Thu":"11 AM to 10 PM","Fri":"11 AM to 11 PM","Sat":"11 AM to 11 PM","Sun":"12 Noon to 9 PM"},"name":"Winger\'s Roadhouse Grill & Bar","mobile":"(801) 363-3666","address":"329 S State St, Salt Lake City UT  84111","cuisines":{"0":"American","1":"BBQ","2":"Burger"},"cost":{"0":"$","1":"$"},"location":"Downtown","highlights":{"0":"Delivery","1":"Takeout Available","2":"Serves Alcohol","3":"Outdoor Seating","4":"Private Dining Area Available","5":"Gluten Free Options","6":"Nightlife","7":"Kid Friendly","8":"Wifi","9":"Vegetarian Friendly","10":"Sports Bar"}},"4":{"workinghours":{"Mon":"11 AM to 1 AM","Tue":"11 AM to 1 AM","Wed":"11 AM to 1 AM","Thu":"11 AM to 1 AM","Fri":"11 AM to 1 AM","Sat":"11 AM to 1 AM","Sun":"11 AM to 1 AM"},"name":"Bourbon House","mobile":"(801) 746-1005","address":"19 E 200 S, Salt Lake City UT  84111","cuisines":{"0":"American","1":"Burger","2":"Bar Food"},"cost":{"0":"$"},"location":"Downtown","highlights":{"0":"Delivery","1":"Takeout Available","2":"Serves Alcohol","3":"Sports Bar","4":"Live Music","5":"Nightlife"}},"5":{"workinghours":{"Mon":"7 AM to 9 PM","Tue":"7 AM to 9 PM","Wed":"7 AM to 9 PM","Thu":"7 AM to 9 PM","Fri":"7 AM to 9 PM","Sat":"8 AM to 9 PM","Sun":"Closed"},"name":"Lamb\'s Grill","mobile":"(801) 364-7166","address":"169 S Main St, Salt Lake City UT  84111","cuisines":{"0":"American","1":"Breakfast"},"cost":{"0":"$","1":"$"},"location":"Downtown","highlights":{"0":"Breakfast","1":"Delivery","2":"Takeout Available","3":"Live Music","4":"Kid Friendly","5":"Wifi","6":"Private Dining Area Available"}},"6":{"workinghours":{},"name":"Bistro 222","mobile":"(801) 456-0347","address":"222 S Main St #140, Salt Lake City UT  84101","cuisines":{"0":"American"},"cost":{"0":"$","1":"$","2":"$"},"location":"Downtown","highlights":{"0":"Delivery","1":"Takeout Available"}},"7":{"workinghours":{},"name":"Wing Nutz at The Gateway","mobile":"(801) 456-4255","address":"188 Rio Grande St, Salt Lake City UT  84101","cuisines":{"0":"American","1":"BBQ"},"cost":{"0":"$"},"location":"Downtown","highlights":{"0":"Delivery","1":"Takeout Available","2":"Serves Alcohol","3":"Live Music","4":"Kid Friendly","5":"Gluten Free Options","6":"Gastro Pub","7":"Outdoor Seating","8":"Wifi","9":"Nightlife","10":"Sports Bar"}},"8":{"workinghours":{"Mon":"4:30 PM to 10 PM","Tue":"4:30 PM to 10 PM","Wed":"4:30 PM to 10 PM","Thu":"4:30 PM to 10 PM","Fri":"4:30 PM to 10 PM","Sat":"4:30 PM to 10 PM","Sun":"4:30 PM to 9 PM"},"name":"Christopher\'s Prime Steak House & Grill","mobile":"(801) 519-8515","address":"134 Pierpont Ave, Salt Lake City UT  84101","cuisines":{"0":"American","1":"Seafood","2":"Steak"},"cost":{"0":"$","1":"$","2":"$","3":"$"},"location":"Downtown","highlights":{"0":"Delivery","1":"Takeout Available","2":"Live Music","3":"Gluten Free Options","4":"Outdoor Seating"}},"9":{"workinghours":{"Mon":"11:30 AM to 9 PM","Tue":"11:30 AM to 9 PM","Wed":"11:30 AM to 9 PM","Thu":"11:30 AM to 9 PM","Fri":"11:30 AM to 10 PM","Sat":"11:30 AM to 10 PM","Sun":"4 PM to 9 PM"},"name":"Blue Iguana","mobile":"(801) 533-8900","address":"165 S West Temple, Salt Lake City UT  84101","cuisines":{"0":"Mexican","1":"Southwestern"},"cost":{"0":"$","1":"$"},"location":"Downtown","highlights":{"0":"Takeout Available","1":"Serves Alcohol","2":"Outdoor Seating","3":"Wifi"}},"10":{"workinghours":{"Mon":"8 AM to 9 PM","Tue":"8 AM to 9 PM","Wed":"8 AM to 9 PM","Thu":"8 AM to 9 PM","Fri":"8 AM to 9 PM","Sat":"8 AM to 9 PM","Sun":"9 AM to 3 PM"},"name":"Mollie & Ollie","mobile":"Not Available","address":"159 Main Street UT  84111","cuisines":{"0":"American","1":"California","2":"Healthy Food"},"cost":{},"location":"Downtown","highlights":{"0":"Breakfast","1":"Delivery","2":"Takeout Available","3":"Lunch Menu","4":"Serves Organic Food","5":"Vegetarian Friendly"}},"11":{"workinghours":{"Mon":"11:30 AM to 10 PM","Tue":"11:30 AM to 10 PM","Wed":"11:30 AM to 10 PM","Thu":"11:30 AM to 2 AM","Fri":"11:30 AM to 2 AM","Sat":"11:30 AM to 2 AM","Sun":"4 PM to 8 PM"},"name":"SoCo","mobile":"(801) 532-3946","address":"319 Main Street, Salt Lake City UT  84111","cuisines":{"0":"Southern"},"cost":{},"location":"Downtown","highlights":{"0":"Takeout Available"}},"12":{"workinghours":{"Mon":"11 AM to 8:30 PM","Tue":"11 AM to 8:30 PM","Wed":"11 AM to 8:30 PM","Thu":"11 AM to 8:30 PM","Fri":"11 AM to 10 PM","Sat":"11 AM to 10 PM","Sun":"Closed"},"name":"Chedda Burger","mobile":"(602) 865-9797","address":"26 E 600 S, Salt Lake City UT  84111","cuisines":{"0":"Burger"},"cost":{"0":"$","1":"$"},"location":"Downtown","highlights":{"0":"Takeaway Only","1":"Wifi"}},"13":{"workinghours":{},"name":"Kiitos Brewing","mobile":"(801) 215-9165","address":"608 West 700 South, Salt Lake City UT  84104","cuisines":{"0":"American"},"cost":{},"location":"Downtown","highlights":{"0":"Takeout Available","1":"Beer","2":"Nightlife"}},"14":{"workinghours":{},"name":"5th Street Grill","mobile":"(801) 323-7575","address":"150 W 500 S, Salt Lake City UT  84101","cuisines":{"0":"American"},"cost":{},"location":"Downtown","highlights":{"0":"Delivery","1":"Takeout Available"}},"15":{"workinghours":{"Mon":"7:30 AM to 3 PM","Tue":"7:30 AM to 3 PM","Wed":"7:30 AM to 3 PM","Thu":"7:30 AM to 3 PM","Fri":"7:30 AM to 3 PM","Sat":"Closed","Sun":"Closed"},"name":"Judge Cafe & Grill","mobile":"(801) 531-0917","address":"8 E Broadway, Salt Lake City UT  84111","cuisines":{"0":"American","1":"Mexican"},"cost":{"0":"$"},"location":"Downtown","highlights":{"0":"Breakfast","1":"Delivery","2":"Takeout Available","3":"Kid Friendly"}},"16":{"workinghours":{},"name":"Big Willies","mobile":"(801) 463-4996","address":"1717 South Main Street, Salt Lake City","cuisines":{"0":"American"},"cost":{},"location":"Downtown","highlights":{"0":"Breakfast","1":"Takeout Available","2":"Wine and Beer","3":"Nightlife","4":"Wifi","5":"Vegan Options"}},"17":{"workinghours":{"Mon":"11:30 AM to 10 PM","Tue":"11:30 AM to 10 PM","Wed":"11:30 AM to 10 PM","Thu":"11:30 AM to 10 PM","Fri":"11:30 AM to 10:30 PM","Sat":"11:30 AM to 10:30 PM","Sun":"10 AM to 9 PM"},"name":"Market Street Oyster Bar Downtown","mobile":"(801) 531-6044","address":"54 W Market St, Salt Lake City UT  84101","cuisines":{"0":"American","1":"International","2":"Seafood"},"cost":{"0":"$","1":"$","2":"$"},"location":"Downtown","highlights":{"0":"Delivery","1":"Takeout Available"}},"18":{"workinghours":{"Mon":"7:30 AM to 9:30 AM, 11 AM to 10 PM","Tue":"7:30 AM to 9:30 AM, 11 AM to 10 PM","Wed":"7:30 AM to 9:30 AM, 11 AM to 10 PM","Thu":"7:30 AM to 9:30 AM, 11 AM to 10 PM","Fri":"7:30 AM to 9:30 AM, 11 AM to 11 PM","Sat":"7:30 AM to 9:30 AM, 11 AM to 11 PM","Sun":"7:30 AM to 9:30 AM, 11 AM to 9 PM"},"name":"Oak Wood Fire Kitchen","mobile":"(385) 259-0574","address":"110 W Broadway, Salt Lake City UT  84101","cuisines":{"0":"Pizza","1":"Burger","2":"Italian"},"cost":{"0":"$","1":"$"},"location":"Downtown","highlights":{"0":"Takeout Available","1":"Full Bar Available","2":"Wifi","3":"Sports TV","4":"Craft Beer"}},"19":{"workinghours":{"Mon":"11 AM to 8 PM","Tue":"11 AM to 8 PM","Wed":"11 AM to 8 PM","Thu":"11 AM to 8 PM","Fri":"11 AM to 8 PM","Sat":"11 AM to 8 PM","Sun":"Closed"},"name":"Nordstrom Grill","mobile":"(801) 384-4933","address":"55 S W Temple Salt Lake city UT  84101","cuisines":{"0":"American","1":"Cafe"},"cost":{"0":"$","1":"$"},"location":"Downtown","highlights":{"0":"Takeout Available"}},"20":{"workinghours":{"Mon":"7:30 AM to 12 Midnight","Tue":"7:30 AM to 12 Midnight","Wed":"7:30 AM to 12 Midnight","Thu":"7:30 AM to 12 Midnight","Fri":"7:30 AM to 12 Midnight","Sat":"8 AM to 12 Midnight","Sun":"8 AM to 12 Midnight"},"name":"Nostalgia","mobile":"(801) 532-3225","address":"248 E 100 S, Salt Lake City UT  84111","cuisines":{"0":"American","1":"Coffee and Tea","2":"Deli"},"cost":{"0":"$"},"location":"East Central","highlights":{"0":"Breakfast","1":"Takeout Available","2":"Wifi","3":"Vegan Options","4":"Outdoor Seating","5":"Vegetarian Friendly"}},"21":{"workinghours":{"Mon":"11:30 AM to 10 PM","Tue":"11:30 AM to 10 PM","Wed":"11:30 AM to 10 PM","Thu":"11:30 AM to 10 PM","Fri":"11:30 AM to 10 PM","Sat":"9 AM to 10 PM","Sun":"9 AM to 10 PM"},"name":"Sage\'s Cafe","mobile":"(801) 322-3790","address":"234 West 900 South, Salt Lake City UT  84101","cuisines":{"0":"American","1":"Vegetarian"},"cost":{"0":"$","1":"$"},"location":"Central","highlights":{"0":"Delivery","1":"Takeout Available","2":"Serves Alcohol","3":"Live Music","4":"Kid Friendly","5":"Wifi","6":"Serves Organic Food","7":"Farm-to-Table","8":"Private Dining Area Available","9":"Gluten Free Options","10":"Vegetarian Friendly"}},"22":{"workinghours":{"Mon":"8 AM to 9 PM","Tue":"8 AM to 9 PM","Wed":"8 AM to 9 PM","Thu":"8 AM to 9 PM","Fri":"8 AM to 9:30 PM","Sat":"9 AM to 9:30 PM","Sun":"9 AM to 3 PM"},"name":"Caffe Niche","mobile":"(801) 433-3380","address":"779 E 300 S, Salt Lake City UT  84102","cuisines":{"0":"American","1":"Breakfast"},"cost":{"0":"$","1":"$","2":"$"},"location":"East Central","highlights":{"0":"Breakfast","1":"Delivery","2":"Takeout Available","3":"Serves Alcohol","4":"Private Dining Area Available","5":"Gluten Free Options","6":"BYOW","7":"Serves Cocktails","8":"Outdoor Seating","9":"Wifi","10":"Vegetarian Friendly","11":"Corkage Fee Charged"}},"23":{"workinghours":{"Mon":"11 AM to 2 AM","Tue":"11 AM to 2 AM","Wed":"11 AM to 2 AM","Thu":"11 AM to 2 AM","Fri":"11 AM to 2 AM","Sat":"11 AM to 2 AM","Sun":"11 AM to 2 AM"},"name":"Legends Sports Pub","mobile":"(801) 355-3598","address":"677 S 200 W, Salt Lake City UT  84101","cuisines":{"0":"American","1":"Pizza","2":"Bar Food"},"cost":{"0":"$","1":"$"},"location":"Central","highlights":{"0":"Delivery","1":"Takeout Available","2":"Serves Alcohol","3":"Kid Friendly","4":"Nightlife","5":"Outdoor Seating","6":"Private Dining Area Available","7":"Sports Bar"}},"24":{"workinghours":{},"name":"City Dogs","mobile":"(801) 755-5458","address":"Varying Locations, Salt Lake City UT  84111","cuisines":{"0":"American","1":"Fast Food"},"cost":{"0":"$"},"location":"East Central","highlights":{"0":"Takeout Available","1":"Kid Friendly","2":"Vegetarian Friendly","3":"Outdoor Seating","4":"Private Dining Area Available","5":"Gluten Free Options"}},"25":{"workinghours":{},"name":"Stephen\'s American Bistro","mobile":"(801) 384-3800","address":"110 W 600 S, Salt Lake City UT  84101","cuisines":{"0":"American"},"cost":{"0":"$","1":"$","2":"$"},"location":"Central","highlights":{"0":"Breakfast","1":"Delivery","2":"Takeout Available","3":"Serves Alcohol","4":"Wifi","5":"Sports Bar"}},"26":{"workinghours":{"Mon":"11 AM to 11 PM","Tue":"11 AM to 11 PM","Wed":"11 AM to 11 PM","Thu":"11 AM to 11 PM","Fri":"11 AM to 12 Midnight","Sat":"11 AM to 12 Midnight","Sun":"11 AM to 10 PM"},"name":"Chili\'s Grill & Bar","mobile":"(801) 575-6933","address":"668 E 400 S, Salt Lake City UT  84102","cuisines":{"0":"American"},"cost":{"0":"$","1":"$"},"location":"East Central","highlights":{"0":"Delivery","1":"Takeout Available"}},"27":{"workinghours":{},"name":"Faustina","mobile":"","address":"454 E 300 S, Salt Lake City UT  84111","cuisines":{"0":"American","1":"International"},"cost":{"0":"$","1":"$","2":"$"},"location":"East Central","highlights":{"0":"Delivery","1":"Takeout Available","2":"Serves Alcohol","3":"BYOB","4":"Vegan Options","5":"Live Music","6":"Outdoor Seating","7":"Vegetarian Friendly","8":"Sports Bar"}},"28":{"workinghours":{"Mon":"7 AM to 9 PM","Tue":"7 AM to 9 PM","Wed":"7 AM to 9 PM","Thu":"7 AM to 9 PM","Fri":"7 AM to 10 PM","Sat":"9 AM to 10 PM","Sun":"9 AM to 5 PM"},"name":"Mo\'s American Grill","mobile":"(801) 359-0586","address":"1280 S 300 W, Salt Lake City UT  84101","cuisines":{"0":"Breakfast","1":"Burger","2":"Diner"},"cost":{"0":"$"},"location":"Liberty Wells","highlights":{"0":"Breakfast","1":"Takeaway Only","2":"Serves Alcohol","3":"Kid Friendly"}},"29":{"workinghours":{"Mon":"8 AM to 7 PM","Tue":"8 AM to 7 PM","Wed":"8 AM to 7 PM","Thu":"8 AM to 7 PM","Fri":"8 AM to 7 PM","Sat":"8 AM to 7 PM","Sun":"8 AM to 7 PM"},"name":"Julia\'s","mobile":"(801) 521-4096","address":"51 S 1000 W, Salt Lake City UT  84104","cuisines":{"0":"Mexican","1":"Southwestern"},"cost":{"0":"$"},"location":"Rose Park","highlights":{"0":"Breakfast","1":"Takeaway Only","2":"Kid Friendly"}}}';
        $data_json = $request->data;

        $d = json_decode($data_json, true);
        $data = array();

        //fill city
        echo $d['city'];
        City::firstOrCreate(['name' => $d['city']]);

        foreach ($d as $k=>$v){
            $cost = count($v['cost']);
            $data['mobile'] = $v['mobile'];
            $data['name'] = $v['name'];
            $data['intro'] = ' dfdf';
            $data['address'] = $v['address'];
            $data['lat'] = '41.8819';
            $data['lon'] = '-87.6278';
            $data['site'] = 'site1.com';
            $data['cost'] = $cost;


            //fill places table
            $place_id = DB::table('places')->insertGetId(
                $data
            );

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
}
