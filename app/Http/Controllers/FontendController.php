<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Category;
Use App\Models\Product;
use App\Models\Faq;
use App\Models\Header;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactMessage;
use App\Models\Contact;
use Carbon\Carbon;

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
        $product_category_id = Product::find($product_id)->category_id;
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
    function cart(){
        $carts = Cart::where('ip_address', request()->ip())->get();
        return view('cart');
    }
}
