<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    function subcategory(){
        return view('subcategory.index');
    }
}
