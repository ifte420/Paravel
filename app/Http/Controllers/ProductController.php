<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
class ProductController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    function product(){
        return view('product.index');
    }
    function productpost(Request $request){
        $request->validate([
            'product_name' => 'required | min:2 | max: 50 | unique:products,product_name',
            'product_price' => 'required | integer',
            'product_quantity' => 'required | integer',
            'product_short_description' => 'required | min:5 | max: 1000 ',
            'product_long_description' => 'required | min:10 | max: 3000',
            'product_alert_quantity' => 'required | integer',
        ]);
        Product::insert($request->except('_token') + [
            'created_at'=> Carbon::now(),
        ]);
        return back()->with('product_added', 'Product Added successfully');
    }
}