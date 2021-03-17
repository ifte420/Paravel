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
        foreach ($request->except('_token') as  $key => $value) {
            Setting::where('setting_name', $key)->update([
                'setting_value' => $value,
            ]);
        }
        return back();
    }
}
