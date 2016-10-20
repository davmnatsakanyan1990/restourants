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
//        $data_json = '[{"workinghours":{},"name":"Pago","mobile":"(801) 532-0777","address":"878 S. 900 East, Salt Lake City UT  84102","cuisines":{"0":"American","1":"Italian","2":"California"},"cost":{"0":"$","1":"$","2":"$"},"location":"East Central","highlights":{"0":"Gluten Free Options"},"images":["726fccb8c868e7768a97f5b6e1d9e115_1453600781.jpg","76874b4c28401c4cda6d7e87533e8730.jpg"],"menus":{"Lunch":{"To Start":{"0":{"title":"Pago Daily Soup","price":"6","description":null},"1":{"title":"Pago Salad","price":"7","description":"local greens, shaved roots, parmesan, balsamic"},"2":{"title":"Vadouvan Chicken Wings*","price":"9","description":"raita, cucumbers"},"3":{"title":"Bbq Beets","price":"9","description":"smoked honey, toasted grains, yogurt, shaved root slaw"}},"Entrée Salads":{"0":{"title":"Grilled Chicken Caesar*","price":"14","description":"chopped kale, parmesan, fingerling potato chips, pickled fennel, white anchovy, caesar dressing"},"1":{"title":"Steak Salad*","price":"16","description":"blue cheese, onion rings, pickled peppers, 6 minute egg, balsamic"},"2":{"title":"Little Gem \"Wedge\" Salad*","price":"11","description":"blue cheese crumble, cherry tomato, bacon, tomatillo buttermilk dressing"}},"Sandwiches":{"0":{"title":"Tuna Melt*","price":"12","description":"whole grain aioli, swiss, pickled onion, rye"},"1":{"title":"Cauliflower Po-Boy","price":"12","description":"buttermilk-fried cauliflower, tomatoes, lemon cajun aioli"},"2":{"title":"Coq Au Vin Dip*","price":"14","description":"braised mary\'s chicken, caramelized onions, mushroom, bacon, muenster cheese, whole grain aioli, coq au vin jus"},"3":{"title":"Pago Burger*","price":"14","description":"bacon, gouda, pickled onion, black garlic aioli"},"4":{"title":"Croque Madame*","price":"12","description":"ham, sauce mornay, clifford farms egg"},"5":{"title":"Pork Pastrami on Rye*","price":"12","description":"house cured pork pastrami, pickled cabbage, swiss, russian dressing"}},"Pago Classics":{"0":{"title":"Fish & Chips*","price":"13","description":"market cod, hand cut fries, tartar sauce"},"1":{"title":"Gnocchi","price":"15","description":"basil &amp; pistachio pesto, peas, tomatoes, parmesan"},"2":{"title":"Pago Tacos*","price":"10","description":"daily preparation, black beans"}}},"Brunch":{"Starters":{"0":{"title":"House Made Scones","price":"5","description":"2 scones, house cultured butter, amore jam"},"1":{"title":"Caviar*","price":"17","description":"whey braised potato, whey foam"},"2":{"title":"Bbq Beets","price":"9","description":"smoked honey, toasted grains, yogurt, shaved root slaw"},"3":{"title":"Caesar","price":"9","description":"kale, parmesan, fingerling potato chips, fennel, white anchovy, caesar dressing"},"4":{"title":"Little Gem \"Wedge\" Salad*","price":"11","description":"blue cheese crumble, cherry tomato, bacon, tomatillo buttermilk dressing"},"5":{"title":"Panna Cotta","price":"7","description":"greek yogurt, seasonal fruit, clifford farms honey, local granola"}},"Mains":{"0":{"title":"Dutch Baby Pancake","price":"10","description":"seasonal fruit, powdered sugar"},"1":{"title":"Utah Trout*","price":"15","description":"house tasso ham, greens, grits, poached clifford farms eggs, hollandaise"},"2":{"title":"Huevos Rancheros*","price":"10","description":"scrambled clifford farms eggs, black beans, roasted salsa, tortilla, local cheese"},"3":{"title":"Croque Madame*","price":"12","description":"ham, sauce mornay, sunny side up clifford farms egg, country potatoes"},"4":{"title":"Pago Eggs Benedict*","price":"10","description":"ham, poached clifford farms eggs, hollandaise, country potatoes"},"5":{"title":"Pago Breakfast*","price":"12","description":"scrambled clifford farms eggs, market vegetables, country potatoes"},"6":{"title":"Steak & Eggs*","price":"16","description":"c.a.b. bavette steak, 2 fried clifford farms eggs, country potatoes, raita"},"7":{"title":"Mary\'s Buttermilk Fried Chicken*","price":"12","description":"sawmill gravy, fried clifford farms egg, pickled pepper salad"},"8":{"title":"Coq Au Vin Dip*","price":"14","description":"braised mary\'s chicken, caramelized onions, mushroom, bacon, muenster cheese, coq au vin jus"},"9":{"title":"Pago Burger*","price":"14","description":"pago bacon, gouda, pickled onion, black garlic aioli, country potatoes"},"10":{"title":"Tuna Melt*","price":"12","description":"whole grain aioli, swiss, pickled onion, rye"}},"Sides":{"0":{"title":"Country Potatoes","price":"4","description":null},"1":{"title":"Applewood Smoked Bacon*","price":"5","description":null},"2":{"title":"2 Clifford Farm Eggs to Order*","price":"3","description":null},"3":{"title":"House Fries","price":"5","description":null},"4":{"title":"Pago Salad","price":"7","description":null},"5":{"title":"Caviar Supplement*","price":"14","description":null}}},"Beverage":{"Sparkling":{"0":{"title":"Raventos I Blanc \"L\'hureu \'12 + Macabeo / Parellada / Xarel-Lo + Cava, Spain","price":"7","description":"From the founding family of what is known as \'cava.\' Surely by now they\'ve got great fizz figured out. Lemon bar, white flowers, and chalky minerality"},"1":{"title":"Bonny Doon \"¿Querry?\" \'13 + Apple/Pear/Quince Cider + Ca*","price":"5","description":"Not a wine person? Looking for a gluten free option? Maybe a most refreshing and delicious glass of fermented orchard fruit is more your speed at the moment? What are you waiting for?! Flag someone down, get this!"}},"White":{"0":{"title":"Meli \'14 + Dry Riesling + Maule Valley, Chile*","price":"5","description":"Don\'t be scared, \"dry means \"dry.\" Not sweet...honest! Organic, dry farmed grapes from vines planted in the 50\'s go into this minerally, orange-y, peach-y mother/son collaboration from the maule. Crisp and fresh"},"1":{"title":"Fatalone \'13 + Greco + Puglia, Italy*","price":"5","description":"From the heel of the boot, organically grown and naturally made, this singular white showcases flowers, green apple, guava and honey with persistent mouth watering minerality"},"2":{"title":"Bodegas Avanthia \"Avancia Cuvée De O\" \'13 + Godello + Valdeorras, Spain","price":"5.50","description":"Get to know godello. If you\'re a sauvignon blanc fan and you\'re looking to venture into more textural territory, look no further"}},"Red":{"0":{"title":"Ruth Lewandowski \"Feints\" \'14 + Dolcetto / Barbera / Arneis + Mendocino, Ca (Locally Produced)*","price":"6","description":"Delightfully, refreshingly \"different-er\" than ever before! An experiment gone \'awesome,\' this\'ll win you with its effusive raspberry, savory cinnamon spice and fresh acidity. Zero so2"},"1":{"title":"Tenuta Sant\'antonio \"Scaia\" \'12 + Corvina + Igt Veneto, Italy","price":"5","description":"Corvina in the right hands yields a uniquely delicious wine. A deep core of dark fruit, supple tannins, but it\'s the telltale black tea-like aroma that reels me in"},"2":{"title":"Vinos Divertidos \"Lamoristel Del Pirineo\" \'13 + Moristel + Somotano, Spain*","price":"5.50","description":"Organically grown and vinified simply &amp; without additives, this indigenous, nearly extinct grape yields a fresh, cassis and blackberry laced earthy wine. If it\'s ancient history &amp; new intrigue you\'re after, drink up!"},"3":{"title":"Bodega Colomé \'12 + Malbec Blend + Salta, Argentina","price":"8","description":"From far nw argentina, this is a perennial pago favorite. You\'d be hard pressed to find a better representation of malbec from the new world. Especially elegant and nuanced with deep fruit, herb and espresso"}}},"Chef\'s Tasting Menu (Dinner)":{"One":{"0":{"title":"Idaho Caviar*","price":null,"description":"whey braised potato, whey foam"},"1":{"title":"Raventos I Blanc \"L\'heuru\" \'12 + Macabeo / Parellada / Xarel-Lo + Conca, Spain","price":null,"description":null},"2":{"title":"Reserve: Donkey and Goat \"Lily\'s Cuvee Pet-Nat \'14 + Chardonnay + Anderson Valley, Ca","price":null,"description":null}},"Two":{"0":{"title":"Carrot Tasting","price":null,"description":"raw, confit, pickle, chips, carrot mascarpone"}},"Three":{"0":{"title":"Manila Clams","price":null,"description":"sparkling wine/vermouth broth, spring onion butter, sourdough"},"1":{"title":"Marco Carpineti \'09 + Greco + Lazio, Italy*","price":null,"description":null},"2":{"title":"Reserve: Kumeu River \"Estate\" \'11 + Chardonnay + Kumeu, New Zealand","price":null,"description":null}},"Four":{"0":{"title":"Steak-Frites*","price":null,"description":"c.a.b. bavette steak, yukon frites, nasturtium &amp; pernod béarnaise"},"1":{"title":"Carpe Diem \'12 + Cabernet Sauvignon + Napa, Ca","price":null,"description":null},"2":{"title":"Reserve: Antiyal \'11 + Carmenere/Cabernet/Syrah Maipo, Chile","price":null,"description":null}},"Five":{"0":{"title":"Raspberry Madeleine","price":null,"description":"local berries, citrus custard, sorbetto"},"1":{"title":"Cocchi Americano + Asti, Piedmont, Italy","price":null,"description":null},"2":{"title":"Reserve: Patrick Bottex \"La Ceuille\" Nv + Gamay/Poulsard + Bugey De Cerdon, France","price":null,"description":null}}},"Dinner":{"Small Plates":{"0":{"title":"Caviar*","price":"17","description":"whey braised potato, whey foam"},"1":{"title":"Deviled Eggs*","price":"13","description":"sous vide egg white, squid ink egg yolk, calamari, pimentón"},"2":{"title":"Manila Clams*","price":"18","description":"sparkling wine/vermouth broth, spring onion butter, sourdough"},"3":{"title":"Caesar*","price":"9","description":"chopped kale, parmesan, fingerling potato chips, fennel, white anchovy, caesar dressing"},"4":{"title":"Little Gem \"Wedge\"","price":"11","description":"bacon, bleu crumble, cherry tomato, tomatillo buttermilk dressing"},"5":{"title":"Bbq Beets","price":"9","description":"smoked honey, toasted grains, yogurt, shaved root slaw"},"6":{"title":"Carrot Tasting","price":"8","description":"raw, confit, pickle, chips, carrot mascarpone"},"7":{"title":"Artisan Cheese","price":"17","description":"daily selection"},"8":{"title":"Pago Daily Soup","price":"6","description":null}},"Large Plates":{"0":{"title":"Basil & Goat Cheese Cavatelli","price":"18","description":"smoked tomato water, zucchini and eggplant agrodolce"},"1":{"title":"Roast Chicken*","price":"25","description":"farro &amp; white cheddar grits, mushrooms, greens, bacon &amp; apple bbq"},"2":{"title":"Niman Ranch Pork Chop*","price":"28","description":"summer squash, corn, tater tot, smoked blue cheese, basil"},"3":{"title":"Steak-Frites*","price":"34","description":"c.a.b. bavette steak, yukon gold fries, nasturtium &amp; pernod béarnaise"},"4":{"title":"Halibut*","price":"33","description":"bay leaf broth, white bean ragu, turnips, beech mushroom, citrus, capers"},"5":{"title":"Lamb Gnocchi*","price":"23","description":"morgan valley lamb bolognese, heirloom tomato, cured egg yolk"},"6":{"title":"Pago Burger*","price":"18","description":"bacon, gouda, pickled onion, black garlic aioli, truffle frites"}},"For Two":{"0":{"title":"Whole Trout*","price":"48","description":"corn slaw, beluga lentils, orzo, sunflower seeds, dill gremolata"}}}}}]';

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

            //fill menus
            if(!is_null($v['menus'])) {
                foreach ($v['menus'] as $key => $value) {
                    $menu['name'] = $key;
                    $menu['place_id'] = $place_id;

                    $menu_id = DB::table('menus')->insertGetId($menu);
                    $products = [];

                    foreach ($value as $item) {
                        foreach ($item as $i) {
                            $i['menu_id'] = $menu_id;
                            array_push($products, $i);
                        }
                    }
                    DB::table('products')->insert($products);
                }
            }

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
