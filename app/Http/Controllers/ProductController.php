<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Feature_photo;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;
use Auth;


class ProductController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    function product(){
        $categorys = Category::all();
        $products = Product::where('user_id', Auth::id())->get();
        $product_trashed = Product::onlyTrashed()->get();
        return view('product.index', compact('categorys', 'products', 'product_trashed'));
    }
    function productpost(Request $request){
        $request->validate([
            'category_id' => 'integer',
            'product_name' => 'required | min:2 | max: 50 | unique:products,product_name',
            'product_price' => 'required | integer',
            'product_quantity' => 'required | integer',
            'product_short_description' => 'required | min:5 | max: 1000 ',
            'product_long_description' => 'required | min:10 | max: 3000',
            'product_alert_quantity' => 'required | integer',
            'product_image' => 'required | mimes:jpg, jpeg, png, bmp, gif, svg, webp',
            'feature_image.*' => 'image|mimes:jpg, jpeg, png, bmp, gif, svg, webp',
        ]);
        // Catch Image
        $product_image_selete = $request->file('product_image');
        // Random Name
        $image_random_name = Str::random(10).time().'.'.$request->file('product_image')->getClientOriginalExtension();
        // Image Upload
        Image::make($product_image_selete)->resize(600, 550)->save(base_path('public/uploads/product/') .$image_random_name, 50);
        $product_id = Product::insertGetId($request->except('_token', 'product_image', 'feature_image') + [
            'user_id' => Auth::id(),
            'created_at'=> Carbon::now(),
            'product_image'=> $image_random_name,
        ]);

        // Feature Upload and insert code
        if ($request->hasfile('feature_image')) {
            foreach ($request->file('feature_image') as $single_feature_photo) {
                // Catch Image
                $product_image_selete = $single_feature_photo;
                // Random Name
                $image_random_name = Str::random(10).time().'.'.$single_feature_photo->getClientOriginalExtension();
                // Image Upload
                Image::make($product_image_selete)->resize(600, 550)->save(base_path('public/uploads/product_feature/') .$image_random_name, 50);
                Feature_photo::insert([
                    'product_id' => $product_id,
                    'feature_image' => $image_random_name,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return back()->with('product_added', 'Product Added successfully');
    }
    function productsoftdelete($product_id){
        $product_name =  Product::find($product_id)->product_name;
        if(Product::where('id', $product_id)->exists()){
            Product::findOrFail($product_id)->delete();
        }
        return back()->with('single_soft_delete', 'Your '.$product_name.' Product Sorft Delete');
    }

    function product_edit($product_id){
        $product_info = Product::findOrFail($product_id);
        $categorys = Category::all();
        return view('product.edit', compact('product_info', 'categorys'));
    }
    function producteditpost(Request $request, $product_id){
        // if($request->product_name == Product::findOrFail($product_id)->product_name){}
        $request->validate([
            'category_id' => 'integer',
            'product_name' => 'required | min:2 | max: 50 | unique:products,product_name',
            'product_price' => 'required | integer',
            'product_quantity' => 'required | integer',
            'product_short_description' => 'required | min:5 | max: 1000 ',
            'product_long_description' => 'required | min:10 | max: 3000',
            'product_alert_quantity' => 'required | integer',
            'product_new_file' => 'mimes:jpg, jpeg, png, bmp, gif, svg, webp',
        ]);
        if($request->hasfile('product_new_file')){
            // Delete Old Photo
            $image_path = base_path('public/uploads/product/') . Product::findorfail($product_id)->product_image;
            unlink($image_path);
            // Upload New Photo & Catch Image
            $product_image_selete = $request->file('product_new_file');
            // Random Name
            $image_random_name = Str::random(10) . time() . '.' .$request->file('product_new_file')->getClientOriginalExtension();
            // Image Upload
            Image::make($product_image_selete)->resize(600, 550)->save(base_path('public/uploads/product/') .$image_random_name, 50);
            // update the database
            Product::find($product_id)->update([
                'product_image' => $image_random_name,
            ]);
        }
        Product::findOrFail($request->product_id)->update([
            'category_id' =>$request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,
            'product_alert_quantity' => $request->product_alert_quantity,
        ]);
        return redirect('product')->with('edit_success','Your Product Edit Successfully');
    }

    function product_restore($product_id){
        $category_id = Product::onlyTrashed()->find($product_id)->category_id;
        $product_name =  Product::onlyTrashed()->find($product_id)->product_name;
        if (Category::onlyTrashed()->find($category_id)) {
            Category::onlyTrashed()->find($category_id)->restore();
        }
        Product::onlyTrashed()->where('id', $product_id)->restore();
        return back()->with('single_restore', 'Your '.$product_name.' Product Restore');
    }
    function productforce($product_id){
        foreach (Feature_photo::where('product_id', $product_id)->get() as $single_feature_photo) {
            $image_path = base_path('public/uploads/product_feature/').$single_feature_photo->feature_image;
            unlink($image_path);
        }
        $image_path = base_path('public/uploads/product/').Product::onlyTrashed()->find($product_id)->product_image;
        unlink($image_path);
        $product_name =  Product::onlyTrashed()->find($product_id)->product_name;
        Product::onlyTrashed()->where('id', $product_id)->forceDelete();
        return back()->with('single_force', 'Your '.$product_name.' Product permanent Delete');
    }
    function product_restore_all(){
        // foreach ($variable as $key => $value) {
            // $product_name =  Product::onlyTrashed()->find($product_id)->product_name;
            // $category_id = Product::onlyTrashed()->find($product_id)->category_id;
            // if (Category::onlyTrashed()->find($category_id)) {
            //     Category::onlyTrashed()->find($category_id)->restore();
            // }
            // $product_name =  Product::onlyTrashed()->find($product_id)->product_name;
            // Product::onlyTrashed()->where('id', $product_id)->restore();
            // return back()->with('single_restore', 'Your '.$product_name.' Product Restore');
            // }
        Product::onlyTrashed()->restore();
        return back()->with('all_restore', 'Your All product Restore successfully');
    }
    function product_force_delete_all(){
        Product::onlyTrashed()->forceDelete();
        return back()->with('all_force_delete', 'Your All product Restore successfully');
    }
    function product_all_soft_delete(){
        Product::WhereNull('deleted_at')->Delete();
        return back()->with('delete_all_soft', 'Your All product soft delete successfully');
    }
}
