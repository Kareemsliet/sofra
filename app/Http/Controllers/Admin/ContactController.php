<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    function index(Request $request){
        $search=$request->q?$request->q:"";

        $contacts=Contact::select('*')->whereAny(['name','email','title'],'like',"%$search%")->orderByDesc('created_at')->paginate(10);

        $contacts->withQueryString();

        return view('admin.contacts.index',compact('contacts'));
    }

    function destroy(Request $request,$id){

        $contact=Contact::findOrFail($id);

        $contact->delete();

        return redirect()->route('contacts.index')->with("message","تم حذف  بنجاح");
    }

    public function showReplyForm($id){
        $contact=Contact::findOrFail(id: $id);

        return view('admin.contacts.reply',compact('contact'));
    }

    public function reply(Request $request,$id){
        $request->validate([
            'message'=>"required|string|max:350",
        ]);

        $contact=Contact::findOrFail(id: $id);

        Mail::to($contact->email)
        ->send(new \App\Mail\Contact("$request->description",$contact->name));

        return redirect()->route('contacts.replyForm',$id)->with('message',"تم ارسال رسالة  بنجاح");
    }
}
