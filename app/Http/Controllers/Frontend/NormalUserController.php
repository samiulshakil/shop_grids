<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use Auth;

class NormalUserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        return view('frontend.users.dashboard');
    }

    public function editProfile(){
        return view('frontend.users.edit_profile');
    }

        public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id(),
            'avatar' => 'nullable|image', 
        ]);

        $user = User::find(Auth::id());
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if($request->hasFile('avatar')){
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }
        Toastr::success('Successfully Profile Updated', '', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
