<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('verified');
        $this->middleware('checkrole');
    }
    function category(){
        $categories = category::all();
        $deleted_categories = Category::onlyTrashed()->get();
        return view('category.index', compact('categories', 'deleted_categories'));
    }
    function categorypost(Request $request){
        $request->validate([
            'category_name' => 'required | max:50 | min:3 | unique:categories,category_name',
            'category_image' => 'required| mimes:jpg, jpeg, png, bmp, gif, svg, webp',
            'subcategory_name' => 'required | max:50 | min:3 | unique:subcategories,subcategory_name',
            'subcategory_image' => 'required| mimes:jpg, jpeg, png, bmp, gif, svg, webp',
        ],
        [
            'category_name.required' => "Pleace Fill Up The Input File",
            'category_name.min' => "3 ta hoileo daw",
        ]);
        // Catch The Photo
        $photo_select = $request->file('category_image');
        // Randomly Ganerate Name
        $random_photo_name = str::random(10) . time() . '.' . $request->category_image->getClientOriginalExtension();
        // Upload The photo
        Image::make($photo_select)->resize(350, 275)->save(base_path('public/uploads/category/') . $random_photo_name, 50 );
        // Insert
        $category_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
            'category_image' => $random_photo_name,
        ]);
        // Catch The Photo
        $sub_photo_select = $request->file('subcategory_image');
        // Randomly Ganerate Name
        $random_sub_photo_name = str::random(10).time().'.'.$request->subcategory_image->getClientOriginalExtension();
        // Upload The photo
        Image::make($sub_photo_select)->resize(350, 275)->save(base_path('public/uploads/sub_category/') . $random_sub_photo_name, 50 );
        Subcategory::insert([
            'category_id' => $category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_image' => $random_sub_photo_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('category_insert_status', 'Category '. $request->category_name .' Added Successfully');
    }
    function categorydelete($category_id){
        if(Category::where('id', $category_id)->exists()){
            Category::findOrFail($category_id)->delete();
            Product::where('category_id', $category_id)->delete();
        }
        return back()->with('category_delete_status', 'Category Soft Deleted Successfully');
    }
    function categoryalldelete(){
        Category::whereNull('deleted_at')->delete();
        return back()->with('Category_all_delete_status', 'Your All Category Soft Deleted');
    }
    function categoryedit($category_id){
        $category_info = Category::findOrFail($category_id);
        return view('category.edit', compact('category_info'));
    }
    function category_post_edit(Request $request){
        if($request->category_name == Category::findOrFail($request->category_id)->category_name){
            return back()->withErrors("It's the same as before");
        }
        $request->validate([
            'category_name' => 'required | max:20 | min:3 | unique:categories,category_name',
        ]);
        Category::findOrFail($request->category_id)->update([
            'category_name' => $request->category_name,
        ]);
        return redirect('category')->with('category_edit', 'Category' . $request->category_name . ' Edit Successfully');
    }
    function category_restore($category_id){
        Category::onlyTrashed()->where('id', $category_id)->restore();
        $category_name = Category::findOrFail($category_id)->category_name;
        Product::where('category_id', $category_id)->restore();
        return back()->with('category_restore', Str::title($category_name) . ' Category Restore Successfully');
    }
    function categoryforce($category_id){
        $image_path = base_path('public/uploads/category/').Category::onlyTrashed()->find($category_id)->category_image;
        unlink($image_path);
        Category::onlyTrashed()->where('id', $category_id)->forceDelete();
        Product::where('category_id', $category_id)->forceDelete();
        return back()->with('force_delete', 'Category Force Deleted Successfully');
    }
    function category_force_delete_all(){
        Category::onlyTrashed()->forceDelete();
        return back()->with('force_all_delete', 'Your Category Already Force Delete');
    }
    function category_restore_all(){
        Category::onlyTrashed()->restore();
        return back()->with('restore_all', 'Your All Category Restore Successfully');
    }
    function category_check_delete(Request $request){
        if(isset($request->category_id)){
            foreach($request->category_id as $category_id){
                Category::findOrFail($category_id)->delete();
            }
            return back()->with('check_soft_delete','Check Delete Successfully');
        }
        else {
            return back()->with('check_no_data','You have no data selected');
        }
    }
    function category_soft_check(Request $request){
        // print_r($request->all());
        if(isset($request->restore)){
            if(isset($request->delete_id)){
                foreach($request->delete_id as $delete_id){
                    // Category::findOrFail($delete_id)->restore();
                    Category::where('id', $delete_id)->restore();
                }
                return back()->with('check_restore','Check Restore Successfully');
            }
            else {
                return back()->with('check_no_select_data','You have no data selected');
            }
        }
        if(isset($request->force_delete)){
            if(isset($request->delete_id)){
                foreach($request->delete_id as $delete_id){
                    Category::where('id', $delete_id)->forceDelete();
                }
                return back()->with('check_force_delete','Check Force Delete Successfully');
            }
            else {
                return back()->with('check_no_select_data','You have no data selected');
            }
        }
    }
}
