<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    function product(){
        return view('product.index');
    }
    function productpost(Request $request){
        $request->validate([
            'product_name' => 'required | min:2 | max: 20 ',
            'product_price' => 'required | min:3 | max: 10 ',
            'product_quantity' => 'required | integer',
            'product_short_description' => 'required | min:10 | max: 1000 ',
            'product_long_description' => 'required | min:20 | max: 3000',
            'product_alert_quantity' => 'required | integer',
        ]);
    }
}
