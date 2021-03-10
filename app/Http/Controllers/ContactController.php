<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
   public function __construct() {
        $this->middleware('auth');
    }
    function contact_insert(Request $request){
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
    function contact_backend(){
        $contacts = Contact::all();
        return view('contact.index', compact('contacts'));
    }
    function contact_delete($contact_id){
        Contact::find($contact_id)->delete();
        return back()->with('contact_delete', 'One Message Deleted Successfully');
    }
}
