<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    function category(){
        $deleted_categories = Category::onlyTrashed()->get();
        $categories = category::all();
        return view('category.index', compact('categories', 'deleted_categories'));
    }
    function categorypost(Request $request){
        $request->validate([
            'category_name' => 'required | max:20 | min:3 | unique:categories,category_name',
        ],
        [
            'category_name.required' => "Pleace Fill Up The Input File",
            'category_name.min' => "3 ta hoileo daw",
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('category_insert_status', 'Category '. $request->category_name .' Added Successfully');
    }
    function categorydelete($category_id){
        Category::find($category_id)->delete();
        return back()->with('category_delete_status', 'Category Soft Deleted Successfully');
    }
    function categoryalldelete(){
        Category::whereNull('deleted_at')->delete();
        return back()->with('Category_all_delete_status', 'Your All Category Soft Deleted');
    }
    function categoryedit($category_id){
        $category_info = Category::find($category_id);
        return view('category.edit', compact('category_info'));
    }
    function category_post_edit(Request $request){
        if($request->category_name == Category::find($request->category_id)->category_name){
            return back()->withErrors("It's the same as before");
        }
        $request->validate([
            'category_name' => 'required | max:20 | min:3 | unique:categories,category_name',
        ]);
        Category::find($request->category_id)->update([
            'category_name' => $request->category_name,
        ]);
        return redirect('category')->with('category_edit', 'Category' . $request->category_name . ' Edit Successfully');
    }
    function category_restore($category_id){
        Category::onlyTrashed()->where('id', $category_id)->restore();
        $category_name = Category::find($category_id)->category_name;
        return back()->with('category_restore', Str::title($category_name) . ' Category Restore Successfully');
    }
    function categoryforce($category_id){
        Category::onlyTrashed()->where('id', $category_id)->forceDelete();
        return back()->with('force_delete', 'Category Force Deleted Successfully');
    }
    function category_force_delete_all(){
        Category::onlyTrashed()->forceDelete();
        return back()->with('force_all_delete', 'Your Category Already Force Delete');
    }
    function category_restore_all(){
        Category::onlyTrashed()->restore();
        return back()->with('restore_all', 'Your Category Already Force Delete');
    }
    function category_check_delete(Request $request){
        if(isset($request->category_id)){
            foreach($request->category_id as $category_id){
            Category::find($category_id)->delete();
            }
            return back()->with('check_soft_delete','Check Delete Successfully');
        }
        else {
            return back()->with('check_no_data','You have no data selected');
        }

    }
}
