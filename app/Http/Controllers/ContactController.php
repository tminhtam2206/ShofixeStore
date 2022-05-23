<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function postAdd(Request $data){
        $contact = new Contact();
        $contact->name = $data->name;
        $contact->email = $data->email;
        $contact->content = $data->content;
        $contact->save();

        return redirect()->route('frontend.contact.success');
    }

    public function success(){
        return view('frontend.contact_successfully');
    }

    public static function show(){
        return Contact::get();
    }
}
