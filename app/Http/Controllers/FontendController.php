<?php

namespace App\Http\Controllers;
session_start();

use Illuminate\Http\Request;
Use App\Models\Product , App\Models\User;
Use App\Models\Category;
use App\Models\Faq;
use App\Models\Header;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactMessage;
use App\Models\Contact;
use App\Models\Cupon;
use Carbon\Carbon;
use Hash, Auth;

class FontendController extends Controller
{
    function index(){
        $headers = Header::all();
        $categories = Category::all();
        $products = Product::latest()->get();
        return view('welcome', compact('categories', 'products', 'headers'));
    }
    function about(){
        return view('about');
    }
    function frontend_contact(){
        return view('contact');
    }
    function contact_insert(Request $request){
        $person_name = $request->person_name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        $all_info = [
            $person_name, $email, $subject, $message
        ];
        Mail::to('ifte430@gmail.com')->send(new SendContactMessage($all_info));
        $request->validate([
            'person_name' => 'required | max:50',
            'email' => 'required | unique:contacts,email', 
            'subject' => 'required | max:500', 
            'message' => 'required | max:2000', 
        ]);
        Contact::insert($request->except('_token') + [
            'created_at' => Carbon::now(),
        ]);
        return back()->with('contact_send_success', 'Your Messege Send Successfully');
    }
    function product_details($product_id){
        $faqs = Faq::all();
        $product_category_id = Product::findOrFail($product_id)->category_id;
        $related_product = Product::where('category_id', $product_category_id)->where('id', '!=', $product_id)->get();
        $products = Product::find($product_id);
        return view('product_details', compact('products', 'faqs', 'related_product'));
    }
    function shop(){
        $products = Product::inRandomOrder()->get();
        $categories = Category::all();
        return view('shop', compact('products', 'categories'));
    }
    function category_wise_shop($category_id){
        $one_category = Category::find($category_id);
        $products = Product::where('category_id', $category_id)->get();
        return view('categorywiseshop', compact('products', 'one_category'));
    }
    function cart($cupon_name=""){
        $cupon_discount = 0;
        if($cupon_name == ""){
            $cupon_discount = 0;
        }
        else{
            if(Cupon::where('cupon_name', $cupon_name)->exists()){
                if(Cupon::where('cupon_name', $cupon_name)->first()->expire_date >= Carbon::now()->format('Y-m-d')){
                    if(Cupon::where('cupon_name', $cupon_name)->first()->uses_limit > 0){
                        $cupon_discount = Cupon::where('cupon_name', $cupon_name)->first()->discount_amount;
                    }
                    else{
                        return back()->with('limit_finish', 'The limit is over');
                    }
                }
                else {
                    return back()->with('expire', 'The date has Expired');
                }
            }
            else {
                return back()->with('invalid', 'Invalid cupon name');
                // return back()->with(compact('cupon_name'))->with('invalid', 'Invalid cupon name');
            }
        }
        return view('cart',[
        'carts' => Cart::where('ip_address', request()->ip())->get(),
        'cupon_discount' => $cupon_discount,
        'cupon_name' => $cupon_name,
        ]);
    }
    function update_cart(Request $req){
        foreach ($req->quantity as $cart_id => $quantity) {
            if(Product::find(Cart::find($cart_id)->product_id)->product_quantity >= $quantity){
                Cart::findOrFail($cart_id)->update([
                    'quantity' => $quantity,
                ]);
            }
            else{
                $_SESSION['quantity_'.$cart_id] = "Please Decrease product quantity";
            }
        }
        return back();
    }
    function checkout(){
        if(Auth::id()){
            return view('checkout');
        }
        else{
            return view('customer_login');
        }
    }

    function customer_register(){
        return view('customer_register');
    }
    function customer_register_post(Request $request){
        $encrypt_password = bcrypt($request->password);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $encrypt_password,
            'role' => 2,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function customer_login(){
        return view('customer_login');
    }
    function customer_login_post(Request $request){
        if(User::where('email', $request->email)->exists()){
            $db_passowrd = User::where('email', $request->email)->first()->password;
            if(Hash::check($request->password, $db_passowrd)){
                if(Auth::attempt($request->except('_token'))){
                    return redirect()->intended('home');
                }
            }
            else {
                return back()->with('pass_err', 'Your password is incorrect');
            }
        }
        else{
            return back()->with('log_error', 'These credentials do not match our records.');
        }
    }
}
