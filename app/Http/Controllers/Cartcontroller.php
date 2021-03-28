<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Carbon\Carbon;



class Cartcontroller extends Controller
{
    function cartpost(Request $request, $product_id){
        $request->validate([
            'quantity' => 'required | integer',
        ]);

        if(Cart::where('product_id', $product_id)->where('ip_address', request()->ip())->exists()){
            Cart::where('product_id', $product_id)->where('ip_address', request()->ip())->increment('quantity', $request->quantity);
        }
        else{
        Cart::insert([
            'product_id' => $product_id,
            'ip_address' => request()->ip(),
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
        ]);
        }
        return back();
    }
    function cartdelete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }
}
