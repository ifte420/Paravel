<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use carbon\carbon;

class FaqController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    function faq(){
        $faqs = faq::all();
        $faqs_trashed = faq::onlyTrashed()->get();
        return view('faq.index', compact('faqs', 'faqs_trashed'));
    }
    function faq_insert(Request $request){
        $request->validate([
            'question' => 'required | min: 5',
            'answer' => 'required | min: 5', 
        ]);
        Faq::insert($request->except('_token') + [
            'created_at' => Carbon::now(),
        ]);
        return back()->with('faq_added','faq added successfully');
    }
    function faq_soft_delete($faq_id){
        Faq::find($faq_id)->delete();
        return back()->with('soft_delete', 'You faq soft Delete');
    }
    function faq_restore($faq_id){
        Faq::onlyTrashed()->where('id', $faq_id)->restore();
        return back()->with('c', 'You faq restore');
    }
    function faq_force_delete($faq_id){
        Faq::onlyTrashed()->where('id', $faq_id)->forceDelete();
        return back()->with('force_delete', 'You faq force Delete');
    }
}
