<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NormalUserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function dashboard(){
        return view('frontend.users.dashboard');
    }
}
