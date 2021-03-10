<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;


class ProductController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    function product(){
        $categorys = Category::all();
        $products = Product::all();
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
        ]);
        Product::insert($request->except('_token') + [
            'created_at'=> Carbon::now(),
        ]);
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
    function producteditpost(Request $request){
        // if($request->product_name == Product::find($request->product_id)->product_name){
        //     return back()->withErrors('Same Diso ken');
        // }
        $request->validate([
            'category_id' => 'integer',
            'product_name' => 'required | min:2 | max: 50 | unique:products,product_name',
            'product_price' => 'required | integer',
            'product_quantity' => 'required | integer',
            'product_short_description' => 'required | min:5 | max: 1000 ',
            'product_long_description' => 'required | min:10 | max: 3000',
            'product_alert_quantity' => 'required | integer',
        ]);
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
