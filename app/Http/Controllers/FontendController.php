<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Category;
Use App\Models\Product;

class FontendController extends Controller
{
    function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('welcome', compact('categories'));
    }
    function about(){
        return view('about');
    }
    function contact(){
        return view('contact');
    }
}
