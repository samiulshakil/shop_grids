<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function editPassword(){
        return view('backend.pages.password.edit');
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
}
