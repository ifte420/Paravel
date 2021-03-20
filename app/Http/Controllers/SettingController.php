<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    function setting(){
        $setting = Setting::all();
        return view('setting.index', compact('setting'));
    }
    function settingpost(Request $request){
        // print_r($request->all());
        // die();
        $request->validate([
            'phone_number' => 'integer',
            'email_address' => 'email',
            // 'address' => '',
            // 'footer_short_description' => '',
            // 'facebook_link' => '',
            // 'twitter_link' => '',
            // 'linkedin_link' => '',
        ]);
        foreach ($request->except('_token') as  $key => $value) {
            Setting::where('setting_name', $key)->update([
                'setting_value' => $value,
            ]);
        }
        return back();
    }
}
