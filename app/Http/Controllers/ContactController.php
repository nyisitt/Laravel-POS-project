<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //user contact page
    public function contactPage(){
        return view("user.contact.contact");
    }
    // data push
    public function dataPush(Request $request){
       $data = [
        'name'=>$request->name,
        'email'=>$request->email,
        'message'=>$request->message
       ];
       Contact::create($data);
       return back()->with(['message'=>'Your message sent to Admin']);
    }

    // admin contact page
    public function adminContactPage(){
       $contact= Contact::paginate(5);
    //    dd($contact->toArray());
        return view('admin.contact.admincontact',compact('contact'));
    }

    // Detail Message
    public function messageDetail($id){
       $message = Contact::select('message')->where('id',$id)->first();
           return view('admin.contact.detail',compact('message'));
    }
}
