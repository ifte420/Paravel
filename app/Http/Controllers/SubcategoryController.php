<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

class SubcategoryController extends Controller 
{
    public function __construct() {
        $this->middleware('verified');
        $this->middleware('checkrole');
    }
    function subcategory(){
        $categorys = Category::all();
        $subcategorys = Subcategory::all();
        $subcategorys_trashed = Subcategory::onlyTrashed()->get();
        return view('subcategory.index', compact('categorys', 'subcategorys', 'subcategorys_trashed'));
    }
    function subcategory_post(Request $request){
        $request->validate([
            'category_id' => 'required | integer',
            'subcategory_name' => 'required | max:50 | min:3 | unique:subcategories,subcategory_name',
            'subcategory_image' => 'required| mimes:jpg, jpeg, png, bmp, gif, svg, webp',
        ]);
        // Catch The Photo
        $photo_select = $request->file('subcategory_image');
        // Randomly Ganerate Name
        $random_photo_name = str::random(10).time().'.'.$request->subcategory_image->getClientOriginalExtension();
        // Upload The photo
        Image::make($photo_select)->resize(350, 275)->save(base_path('public/uploads/sub_category/') . $random_photo_name, 50 );
        Subcategory::insert($request->except('_token', 'subcategory_image')+[
            'subcategory_image' => $random_photo_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('insert_success', 'Sub Category insert Successfully');
    }
    function subcategorydelete($sub_category_id){
        Subcategory::find($sub_category_id)->delete();
        return back()->with('soft_delete', 'Sub Category soft delete successfully');
    }
    function subcategoryedit($sub_category_id){
        $subcategor_info = Subcategory::find($sub_category_id);
        $categorys =  Category::all();
        return view('subcategory.edit', compact('subcategor_info', 'categorys'));
    }
    function subcategory_post_edit(Request $request , $sub_category_id){
        $request->validate([
            'category_id' => 'required | integer',
            'subcategory_name' => 'required | max:50 | min:3 | unique:subcategories,subcategory_name',
            'subcategory_image' => 'mimes:jpg, jpeg, png, bmp, gif, svg, webp',
        ]);
        if($request->hasfile('subcategory_image')){
            // Delete Old Photo
            $image_path = base_path('public/uploads/sub_category/') . Subcategory::findOrFail($sub_category_id)->subcategory_image;
            unlink($image_path);
            // Upload New Photo & Catch Image
            $subcategory_image_selete = $request->file('subcategory_image');
            // Random Name
            $image_random_name = Str::random(10) . time() . '.' .$request->file('subcategory_image')->getClientOriginalExtension();
            // Image Upload
            Image::make($subcategory_image_selete)->resize(600, 550)->save(base_path('public/uploads/sub_category/') .$image_random_name, 50);
            // update the database
            Subcategory::find($sub_category_id)->update([
                'subcategory_image' => $image_random_name,
            ]);
        }
        Subcategory::find($sub_category_id)->Update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
        ]);
        return back();
        // echo "Hello ";
    }
    function subcategoryrestore($sub_category_id){
        Subcategory::onlyTrashed($sub_category_id)->restore();
        return back()->with('single_restore', 'Sub Category Restore Successfully');
    }
    function subcategoryfocedelete($sub_category_id){
        $image_path = base_path('public/uploads/sub_category/').Subcategory::onlyTrashed()->find($sub_category_id)->subcategory_image;
        unlink($image_path);
        Subcategory::onlyTrashed($sub_category_id)->forceDelete();
        return back()->with('single_force_delete', 'Sub Category Force Delete Successfuly');
    }
    function allsoftdelete(){
        Subcategory::whereNull('deleted_at')->delete();
        return back()->with('softall', 'Sub category soft');
    }
    function subcategoryallrestore(){
        Subcategory::onlyTrashed()->restore();
        return back()->with('restore_all', 'Sub category all restore');
    }
    function subcategoryallforcedelete(){
        Subcategory::onlyTrashed()->forceDelete();
        return back()->with('forcedelete', 'Sub category all force delete');
    }
}
