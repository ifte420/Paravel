<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Header;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

class HeaderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    function header(){
        $headers_normal = Header::all();
        $header_trased = Header::onlyTrashed()->get();
        return view('header.index', compact('headers_normal', 'header_trased'));
    }
    function header_post(Request $request){
        // print_r($request->all());
        $request->validate([
            'header_title' => 'required | max:50 | min:3',
            'header_description' => 'required',
            'header_image' => 'required| mimes:jpg, jpeg, png, bmp, gif, svg, webp',
        ]);
        // Catch The Photo
        $photo_select = $request->file('header_image');
        // Randomly Ganerate Name
        $random_photo_name = str::random(10) . time() . '.' .  $request->header_image->getClientOriginalExtension();
        // Upload The photo
        Image::make($photo_select)->resize(1920, 1000)->save(base_path('public/uploads/header/') . $random_photo_name, 50 );

        Header::insert($request->except('_token', 'header_image')+[
            'created_at' => Carbon::now(),
            'header_image' => $random_photo_name, 
        ]);
        return back()->with('header_insert', 'Header Insert Successfully');
    }
    function header_soft($header_id){
        Header::find($header_id)->delete();
        return back()->with('single_soft', 'Header soft Delete successfully');
    }
    function header_soft_all(){
        Header::whereNull('deleted_at')->delete();
        return back()->with('all_soft', 'Header All soft Delete successfully');
    }
    function header_force($header_id){
        $image_path = base_path('public/uploads/header/').Header::onlyTrashed()->find($header_id)->header_image;
        unlink($image_path);
        Header::onlyTrashed()->where('id', $header_id)->forceDelete();
        return back()->with('single_force', 'One Header Froce Delete');
    }
    function header_restore($header_id){
        Header::onlyTrashed()->where('id', $header_id)->restore();
        return back()->with('single_restore', 'header restore successfully');
    }
    function restore_all(){
        Header::onlyTrashed()->restore();
        return back()->with('single_restore', 'header all restore successfully');
    }
}
