<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
   public function __construct() {
        $this->middleware('auth');
        $this->middleware('checkrole');
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
