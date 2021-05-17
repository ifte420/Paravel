<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Str;
use Image;

class SettingController extends Controller
{
    public function __construct() {
        $this->middleware('verified');
        $this->middleware('checkrole');
    }
    function setting(){
        $setting = Setting::all();
        return view('setting.index', compact('setting'));
    }
    function settingpost(Request $request){
        // die();
        $request->validate([
            'phone_number' => 'integer',
            'email_address' => 'email',
            'website_logo' => 'required| mimes:jpg,jpeg,png,bmp,gif,svg,webp',
            // 'address' => '',
            // 'footer_short_description' => '',
            // 'facebook_link' => '',
            // 'twitter_link' => '',
            // 'linkedin_link' => '',
        ]);
        if($request->file('website_logo')){
            if(Setting::where('setting_name','website_logo')->first()->setting_value){
                $image_path = base_path('public/uploads/setting_photo/').Setting::where('setting_name','website_logo')->first()->setting_value;
                unlink($image_path);
            }
            // Catch The Photo
            $photo_select = $request->file('website_logo');
            // Randomly Ganerate Name
              $random_photo_name = str::random(10) . time() . '.' . $request->website_logo->getClientOriginalExtension();
            // Upload The photo
            $Image = Image::make($photo_select)->resize(125, 35)->save(base_path('public/uploads/setting_photo/') . $random_photo_name, 50 );
            // Insert Photo
            setting::where('setting_name','website_logo')->update([
                'setting_value' => $random_photo_name,
            ]);
        }
        foreach ($request->except('_token', 'website_logo') as  $key => $value) {
            Setting::where('setting_name', $key)->update([
                'setting_value' => $value,
            ]);
        }
        return back();
    }
}
