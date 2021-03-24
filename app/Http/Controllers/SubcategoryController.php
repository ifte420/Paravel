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
    function subcategory(){
        $categorys = Category::all();
        $subcategorys = Subcategory::all();
        $subcategorys_trashed = Subcategory::onlyTrashed()->get();
        return view('subcategory.index', compact('categorys', 'subcategorys', 'subcategorys_trashed'));
    }
    function subcategory_post(Request $request){
        $request->validate([
            'category_id' => 'required | integer',
            'subcategory_name' => 'required | max:50 | min:3 | unique:categories,category_name',
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
        return back();
    }
    function subcategorydelete($sub_category_id){
        Subcategory::find($sub_category_id)->delete();
        return back();
    }
    function subcategoryrestore($sub_category_id){
        Subcategory::onlyTrashed($sub_category_id)->restore();
        return back();
    }
    function subcategoryfocedelete($sub_category_id){
        $image_path = base_path('public/uploads/sub_category/').Subcategory::onlyTrashed()->find($sub_category_id)->subcategory_image;
        unlink($image_path);
        Subcategory::onlyTrashed($sub_category_id)->forceDelete();
        return back();
    }
}
