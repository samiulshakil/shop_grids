<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
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

        public function editPassword(){
        return view('frontend.users.edit_password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|string|min:8',
        ]);

        $user = User::find(Auth::id());

        $hashedPassword = $user->password;
        if (Hash::check($request->current_password, $hashedPassword)) { 
            if (!Hash::check($request->password, $hashedPassword)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                Auth::logout();
                Toastr::success('Successfully Password Changed', '', ["positionClass" => "toast-top-right"]);
                return redirect()->route('login');
            } else {
                Toastr::warning('New Password Cannot be same as old password', '', ["positionClass" => "toast-top-right"]);
            }
        } else {
            Toastr::warning('Current password not match', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }

    public function userOrder(){

    }
}
