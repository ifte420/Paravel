<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Header;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

class HeaderController extends Controller
{
    function header(){
        $headers_normal = Header::all();
        return view('header.index', compact('headers_normal'));
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
}
