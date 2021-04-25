<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cupon;
use App\Models\Order;
use App\Models\Order_details;
use Auth;
Use PDF;
Use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::latest()->get();
        $cupons = Cupon::all();
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('home', compact('users', 'cupons', 'orders'));
    }
    public function download_invoice($order_id){
        $order_data = Order::find($order_id);
        $order_details = Order_details::where('order_id', $order_id)->get();
        $pdf = PDF::loadView('pdf.invoice', compact('order_data', 'order_details'));
        return $pdf->stream('invoice'.Carbon::now().'.pdf');
    }
}
