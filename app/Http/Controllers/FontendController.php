<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Category;
Use App\Models\Product;

class FontendController extends Controller
{
    function index(){
        $categories = Category::all();
        $products = Product::latest()->get();
        return view('welcome', compact('categories', 'products'));
    }
    function about(){
        return view('about');
    }
    function contact(){
        return view('contact');
    }
    function product_details($product_id){
        $products = Product::find($product_id);
        $category_info = Category::find($products->category_id);
        return view('product_details', compact('products', 'category_info'));
    }
}
