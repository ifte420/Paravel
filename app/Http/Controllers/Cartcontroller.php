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
        Cart::insert([
            'product_id' => $product_id,
            'ip_address' => request()->ip(),
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}
