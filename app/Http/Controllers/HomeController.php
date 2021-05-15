<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cupon;
use App\Models\Customerorder;
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
        $this->middleware('verified');
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
        $orders = Customerorder::where('user_id', Auth::id())->latest()->get();
        $credit_card = Customerorder::where('payment_status', 1)->count();
        $cod = Customerorder::where('payment_status', 2)->count();
        return view('home', compact('users', 'cupons', 'orders', 'credit_card', 'cod'));
    }
    public function download_invoice($order_id){
        $order_data = Customerorder::find($order_id);
        $order_details = Order_details::where('order_id', $order_id)->get();
        $pdf = PDF::loadView('pdf.invoice', compact('order_data', 'order_details'));
        return $pdf->stream('invoice'.Carbon::now().'.pdf');
    }
}
