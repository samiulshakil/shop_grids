<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;

class ProfileController extends Controller
{
    public function edit(){
        return view('backend.pages.profile.edit');
    }

    public function update(Request $request){
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
