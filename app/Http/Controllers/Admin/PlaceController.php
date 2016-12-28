<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\City;
use App\Models\Cuisin;
use App\Models\Highlight;
use App\Models\Image;
use App\Models\Place;
use App\Models\PlaceCategory;
use App\Models\PlaceCuisin;
use App\Models\PlaceHighlight;
use App\Models\PlaceType;
use App\Models\Type;
use App\Models\WorkingHour;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        $cover_images = Place::with('coverImages')->find($this->place->id)->coverImages->toArray();

        $hours = array();

        $hours['mon'] = $place['workinghour']['mon'];
        $hours['tue'] = $place['workinghour']['tue'];
        $hours['wed'] = $place['workinghour']['wed'];
        $hours['thu'] = $place['workinghour']['thu'];
        $hours['fri'] = $place['workinghour']['fri'];
        $hours['sat'] = $place['workinghour']['sat'];
        $hours['sun'] = $place['workinghour']['sun'];

        $d = array();

        foreach ($hours as $k=>$value){

            if($value != 'Closed' && $value != '') {
                $parts = explode(',', $value);
                foreach ($parts as $key => $part) {

                    $ex = explode('to', $part);
                    $from = $ex[0];
                    $to = $ex[1];

                    $from_hr = explode(':', date('H:i', strtotime($from)))[0];
                    $from_min = explode(':', date('H:i', strtotime($from)))[1];

                    $to_hr = explode(':', date('H:i', strtotime($to)))[0];
                    $to_min = explode(':', date('H:i', strtotime($to)))[1];

                    $d[$k][$key]['from']['hr'] = $from_hr;
                    $d[$k][$key]['from']['min'] = $from_min;

                    $d[$k][$key]['to']['hr'] = $to_hr;
                    $d[$k][$key]['to']['min'] = $to_min;

                }
            }
            else{
                $d[$k] = 'Closed';
            }
        }
        
        return view('admin.place_edit', compact('d', 'place', 'locations', 'all_cities', 'all_cuisins', 'all_highlights', 'all_types', 'all_categories', 'cover_images'));
    }
    
    public function update(Request $request){
       // dd($request->all());
        $categories = $request->categories;
        $cuisins = $request->cuisins;
        $highlights = $request->services;
        $types = $request->types;

        //remove old categories
         PlaceCategory::where('place_id', $this->place->id)->delete();
        // add new categories
        if(count($categories) > 0) {
            foreach ($categories as $category) {
                PlaceCategory::create(['place_id' => $this->place->id, 'category_id' => $category]);
            }
        }

        //remove old cuisins
        PlaceCuisin::where('place_id', $this->place->id)->delete();
        //add new cuisins
        if(count($cuisins) > 0) {
            foreach ($cuisins as $cuisin) {
                PlaceCuisin::create(['place_id' => $this->place->id, 'cuisin_id' => $cuisin]);
            }
        }

        //remove old highlights
        PlaceHighlight::where('place_id', $this->place->id)->delete();
        //add new highlights
        if(count($highlights) > 0) {
            foreach ($highlights as $highlight) {
                PlaceHighlight::create(['place_id' => $this->place->id, 'highlight_id' => $highlight]);
            }
        }

        //remove old types
        PlaceType::where('place_id', $this->place->id)->delete();
        //add new types
        if(count($types) > 0) {
            foreach ($types as $type) {
                PlaceType::create(['place_id' => $this->place->id, 'type_id' => $type]);
            }
        }

        // update working hours

        // monday
        
        $working_hours = array();
        if(isset($request->mon['index'])){
            $mon = array();
            foreach($request->mon['data'] as $part){
                $from = date('g:i a', strtotime($part['from']['hr'].':'.$part['from']['min']));
                $to = date('g:i a', strtotime($part['to']['hr'].':'.$part['to']['min']));
                array_push($mon, $from.' to '.$to);
            }
            $working_hours['mon'] = '';
            if(count($mon) > 1) {
                foreach ($mon as $k=>$p) {
                    if($k==0)
                        $working_hours['mon'] = $p;
                    else
                        $working_hours['mon'] = $working_hours['mon'] . ', ' . $p;
                }
            }
            else{
                $working_hours['mon'] = $mon[0];
            }
        }
        else{
            $working_hours['mon'] = 'Closed';
        }

        // tuesday
        if(isset($request->tue['index'])){
            $tue = array();
            foreach($request->tue['data'] as $part){
                $from = date('g:i a', strtotime($part['from']['hr'].':'.$part['from']['min']));
                $to = date('g:i a', strtotime($part['to']['hr'].':'.$part['to']['min']));
                array_push($tue, $from.' to '.$to);
            }
            $working_hours['tue'] = '';
            if(count($tue) > 1) {
                foreach ($tue as $k=>$p) {
                    if($k==0)
                        $working_hours['tue'] = $p;
                    else
                        $working_hours['tue'] = $working_hours['tue'] . ', ' . $p;
                }
            }
            else{
                $working_hours['tue'] = $tue[0];
            }
        }
        else{
            $working_hours['tue'] = 'Closed';
        }

        //wednesday
        if(isset($request->wed['index'])){
            $wed = array();
            foreach($request->tue['data'] as $part){
                $from = date('g:i a', strtotime($part['from']['hr'].':'.$part['from']['min']));
                $to = date('g:i a', strtotime($part['to']['hr'].':'.$part['to']['min']));
                array_push($wed, $from.' to '.$to);
            }
            $working_hours['wed'] = '';
            if(count($wed) > 1) {
                foreach ($wed as $k=>$p) {
                    if($k==0)
                        $working_hours['wed'] = $p;
                    else
                        $working_hours['wed'] = $working_hours['wed'] . ', ' . $p;
                }
            }
            else{
                $working_hours['wed'] = $wed[0];
            }
        }
        else{
            $working_hours['wed'] = 'Closed';
        }

        // thuesday
        if(isset($request->thu['index'])){
            $thu = array();
            foreach($request->thu['data'] as $part){
                $from = date('g:i a', strtotime($part['from']['hr'].':'.$part['from']['min']));
                $to = date('g:i a', strtotime($part['to']['hr'].':'.$part['to']['min']));
                array_push($thu, $from.' to '.$to);
            }
            $working_hours['thu'] = '';
            if(count($thu) > 1) {
                foreach ($thu as $k=>$p) {
                    if($k==0)
                        $working_hours['thu'] = $p;
                    else
                        $working_hours['thu'] = $working_hours['thu'] . ', ' . $p;
                }
            }
            else{
                $working_hours['thu'] = $thu[0];
            }
        }
        else{
            $working_hours['thu'] = 'Closed';
        }

        // friday
        if(isset($request->fri['index'])){
            $fri = array();
            foreach($request->fri['data'] as $part){
                $from = date('g:i a', strtotime($part['from']['hr'].':'.$part['from']['min']));
                $to = date('g:i a', strtotime($part['to']['hr'].':'.$part['to']['min']));
                array_push($fri, $from.' to '.$to);
            }
            $working_hours['fri'] = '';
            if(count($fri) > 1) {
                foreach ($fri as $k=>$p) {
                    if($k==0)
                        $working_hours['fri'] = $p;
                    else
                        $working_hours['fri'] = $working_hours['fri'] . ', ' . $p;
                }
            }
            else{
                $working_hours['fri'] = $fri[0];
            }
        }
        else{
            $working_hours['fri'] = 'Closed';
        }

        // saturday
        if(isset($request->sat['index'])){
            $sat = array();
            foreach($request->sat['data'] as $part){
                $from = date('g:i a', strtotime($part['from']['hr'].':'.$part['from']['min']));
                $to = date('g:i a', strtotime($part['to']['hr'].':'.$part['to']['min']));
                array_push($sat, $from.' to '.$to);
            }
            $working_hours['sat'] = '';
            if(count($sat) > 1) {
                foreach ($sat as $k=>$p) {
                    if($k==0)
                        $working_hours['sat'] = $p;
                    else
                        $working_hours['sat'] = $working_hours['sat'] . ', ' . $p;
                }
            }
            else{
                $working_hours['sat'] = $sat[0];
            }
        }
        else{
            $working_hours['sat'] = 'Closed';
        }

        if(isset($request->sun['index'])){
            $sun = array();
            foreach($request->sun['data'] as $part){
                $from = date('g:i a', strtotime($part['from']['hr'].':'.$part['from']['min']));
                $to = date('g:i a', strtotime($part['to']['hr'].':'.$part['to']['min']));
                array_push($sun, $from.' to '.$to);
            }
            $working_hours['sun'] = '';
            if(count($sun) > 1) {
                foreach ($sun as $k=>$p) {
                    if($k==0)
                        $working_hours['sun'] = $p;
                    else
                        $working_hours['sun'] = $working_hours['sun'] . ', ' . $p;
                }
            }
            else{
                $working_hours['sun'] = $sun[0];
            }
        }
        else{
            $working_hours['sun'] = 'Closed';
        }

        WorkingHour::where('place_id', $this->place->id)->update($working_hours);

        Place::withTrashed()->find($this->place->id)->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'intro' => $request->intro,
            'address' => $request->address,
            'cost' => $request->cost
        ]);
        
        return redirect()->back()->with('message', 'Data was successfully updated');


    }

    public function addCoverImages(Request $request){
//        dd($request->all());
//        $validator = Validator::make($request->all(), [
//            'files.*' => 'dimensions:min_width=1500,min_height=2015',
//        ]);
//        $messages = $validator->errors();
//
//        echo $messages->first();
//        if ($validator->fails()) {
//            return redirect()->back()
//                ->withErrors($validator);
//        }

        $image_files = $request->file('files');

        $destinationPath = 'images/coverImages';
        foreach ($image_files as $file) {
            $ext = $file->getClientOriginalExtension();
            $unique_id = uniqid();
            $fileName = 'cover'.time().$unique_id.'.'.$ext;

            $file->move($destinationPath, $fileName);
            Image::create(['name'=>$fileName, 'imageable_id' => $this->place->id, 'imageable_type' => 'App\Models\Place', 'role'=>2]);

        }
        return redirect()->back();
    }

    public function deleteCoverImage($id){
        $image = Image::find($id);

        Image::find($id)->delete();
        unlink('images/coverImages/'.$image['name']);
    }
}
