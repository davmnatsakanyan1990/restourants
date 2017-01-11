<?php

namespace App\Http\Controllers\GroupAdmin;

use App\Models\Image;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CoverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:group_admin');
    }
    
    public function index($place_id){
        $restaurant = Place::with('coverImages')->find($place_id);

        return view('group_admin.change_cover', compact('restaurant'));
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
//            'files' => 'dimensions:width=1920,height=800',
        ]);
        $messages = $validator->errors()->all();

        if ($validator->fails()) {
            return response()->json(['files' => [['error' => $messages]]]);
        }

        $image_files = $request->file('files');

        $destinationPath = 'images/coverImages';
        foreach ($image_files as $file) {
            $ext = $file->getClientOriginalExtension();
            $size = $file->getClientSize();
            $mimtype = $file->getClientMimeType();
            $unique_id = uniqid();
            $fileName = 'cover' . time() . $unique_id . '.' . $ext;

            $file->move($destinationPath, $fileName);
            $image = Image::create(['name' => $fileName, 'imageable_id' => $request->place_id, 'imageable_type' => 'App\Models\Place', 'role' => 2]);
            return response()->json(['files' => [
                ['deleteType' => 'POST',
                    'deleteUrl' => url('group_admin/place/cover/delete/'.$image->id),
                    'name' => $fileName,
                    'size' => $size,
                    'thumbnailUrl' => asset('images/coverImages/'.$fileName),
                    'type' => $mimtype,
                    'url' => asset('images/coverImages/'.$fileName)]
            ]
            ]);
        }
    }

    public function delete($image_id){
        $image = Image::find($image_id);

        Image::find($image_id)->delete();
        if(strlen($image['name'])>13)
            unlink('images/coverImages/'.$image['name']);
    }
}
