<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FontendController extends Controller
{
    function index(){
        return view('welcome');
    }
    function about(){
        $country = ["Bd", "Canda", "London"];
        return view('about', compact('country'));
    }
    function dashbroad(){
        return view('dashbroad',[
        'shohan' => "Sir",
        'ifte' => "Hossain"
    ]);
    }
}
