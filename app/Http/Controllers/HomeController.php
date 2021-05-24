<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cupon;
use App\Models\Customerorder;
use App\Models\Order_details;
use Auth;
Use PDF;
Use Hash;
Use Image;
use Illuminate\Support\Str;
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
    function edit_profile(){
        return view('edit_profile');
    }
    function name_update(Request $request){
        // print_r($request->all());
        // Auth::find();
        Auth::user()->where('id', Auth::user()->id)->update([
            'name' => $request->name,
        ]);
        return back()->with('name_succ', 'Your Name Update Successfully');
    }

    function password_update(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required',
        ]);
        $database_pass = Auth::user()->where('id', Auth::user()->id)->first()->password;
        if(Hash::check($request->current_password, $database_pass)){
            Auth::user()->where('id', Auth::user()->id)->update([
                'password' => bcrypt($request->password),
            ]);
            return back()->with('pass_succ', 'Your Password Change Successfully');
        }
        else {
            return back()->with('pass_wrg', 'Your Currant Password Wrong');
        }
    }

    function profile_image(Request $request){
        $request->validate([
            'profile_image' => 'required| mimes:jpg,jpeg,png,bmp,gif,svg,webp',
        ]);
         // Catch The Photo
        $photo_select = $request->file('profile_image');
        // Randomly Ganerate Name
        $random_photo_name = str::random(10) . time() . '.' . $request->profile_image->getClientOriginalExtension();
        // Upload The photo
        Image::make($photo_select)->save(base_path('public/uploads/profile/') . $random_photo_name, 80 );

        Auth::user()->where('id', Auth::user()->id)->update([
            'profile_image' => $random_photo_name,
        ]);
        return back()->with('picture_update', 'Your profile Picture update Succssfully');
    }

}
