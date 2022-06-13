<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ContactUsController extends Controller
{
    public function contactUs(){
        return view('backend.contacts.contact');
    }

    public function messageStore(Request $request){
        $request->validate([
            'name' => 'required|string',
            'subject' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $request->name,
            'subject' => $request->subject,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 1
        ]);

        return redirect()->route('contact.us')->with('message', 'Successfully Message Sent');
    }
}
