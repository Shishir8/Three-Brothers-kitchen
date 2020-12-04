<?php

namespace App\Http\Controllers\Admin;
use App\Models\Contact;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }
    public function show($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.show',compact('contact'));
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        Session::flash('success','Contact Message successfully deleted');
        return redirect()->back();
    }
}

