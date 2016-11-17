<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\City;
use App\Models\Cuisin;
use App\Models\Highlight;
use App\Models\Place;
use App\Models\PlaceCategory;
use App\Models\PlaceCuisin;
use App\Models\PlaceHighlight;
use App\Models\PlaceType;
use App\Models\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{

    public $place;
    public function __construct()
    {
        $this->middleware('auth:admin');

        if(Auth::guard('admin')->check())
            $this->place = Auth::guard('admin')->user()->place;
    }

    public function edit(){
       $place = Place::withTrashed()->with(['highlights', 'cuisins', 'workinghour', 'categories', 'location', 'types'])
            ->find($this->place->id)->toArray();

        $all_cities = City::select('id', 'name')->get()->toArray();

        $locations = City::with('locations')->find($place['location']['city_id'])->locations->toArray();

        $all_cuisins = Cuisin::all()->toArray();

        $all_highlights = Highlight::all()->toArray();

        $all_types = Type::all()->toArray();

        $all_categories = Category::all()->toArray();
//dd($place);
        return view('admin.place_edit', compact('place', 'locations', 'all_cities', 'all_cuisins', 'all_highlights', 'all_types', 'all_categories'));
    }
    
    public function update(Request $request){
        dd($request->all());
        $categories = $request->categories;
        $cuisins = $request->cuisins;
        $highlights = $request->services;
        $types = $request->types;

        //remove old categories
         PlaceCategory::where('place_id', $this->place->id)->delete();
        // add new categories
        foreach ($categories as $category){
            PlaceCategory::create(['place_id'=> $this->place->id, 'category_id'=> $category['id']]);
        }

        //remove old cuisins
        PlaceCuisin::where('place_id', $this->place->id)->delete();
        //add new cuisins
        foreach ($cuisins as $cuisin){
            PlaceCuisin::create(['place_id' => $this->place->id, 'cuisin_id' => $cuisin['id']]);
        }

        //remove old highlights
        PlaceHighlight::where('place_id', $this->place->id)->delete();
        //add new highlights
        foreach ($highlights as $highlight){
            PlaceHighlight::create(['place_id' => $this->place->id, 'highlight_id' => $highlight['id']]);
        }

        //remove old types
        PlaceType::where('place_id', $this->place->id)->delete();
        //add new types
        foreach ($types as $type){
            PlaceType::create(['place_id' => $this->place->id, 'type_id' => $type['id']]);
        }

        // update working hours
        if(isset($request->mon)){
        
        }

        Place::withTrashed()->where('admin_id', $this->place->id)->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'intro' => $request->intro,
            'address' => $request->address,
            'cost' => $request->cost
        ]);


    }
}
