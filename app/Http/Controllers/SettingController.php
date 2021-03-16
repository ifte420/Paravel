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
}
