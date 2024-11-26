<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use Auth, Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    public function custom_login_page(){
        return view('backend.auth.login');
    }

    public function store_login(Request $request){

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $custom_error = [
            'email.required' => "Email is required",
            'password.required' => "Password is required",
        ];

        $this->validate($request, $rules, $custom_error);


        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $admin = User::where('email', $request->email)->first();
        if($admin){
            if($admin->status == 1){
                if(Hash::check($request->password, $admin->password)){
                   if (Auth::attempt($credentials, $request->remember)) {

                        $notify_message = 'Login successfully';
                        Toastr::success($notify_message, '', ["positionClass" => "toast-top-right"]);
                        return redirect()->route('admin.dashboard')->with($notify_message);

                    }
                }else{
                    $notify_message = 'Credential does not match';
                    Toastr::error($notify_message, '', ["positionClass" => "toast-top-right"]);
                    return back();
                }
            }else{
                $notify_message = 'Your account is inactive';
                Toastr::error($notify_message, '', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }else{
            $notify_message = 'Email not found';
            Toastr::error($notify_message, '', ["positionClass" => "toast-top-right"]);
            return back();
        }

    }


    public function admin_logout(){
        
        Auth::logout();

        $notify_message = 'Logout successfully';
        Toastr::success($notify_message, '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.login')->with($notify_message);

    }
}
