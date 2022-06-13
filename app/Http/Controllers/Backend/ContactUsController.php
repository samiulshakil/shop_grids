<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Brian2694\Toastr\Facades\Toastr;

class ContactUsController extends Controller
{
    public function contactUs(){
        return view('frontend.contacts.contact');
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

    public function showMessage(){
        $messages = Message::all();
        return view('backend.pages.messages.index', compact('messages'));
    }

    public function destroy($id){
        $msg = Message::findOrFail($id);
        if ($msg) {
            $msg->delete();
            Toastr::success('Successfully Message Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.message.show');
    }
}
