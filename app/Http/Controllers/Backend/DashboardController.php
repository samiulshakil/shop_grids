<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Gate::authorize('admin.dashboard');
        $users_count =  User::all()->count();
        $users =  User::with('role')->orderBy('created_at', 'desc')->take(10)->get();
        $roles =  Role::all()->count();
        $pages =  Page::all()->count();
        $menus =  Menu::all()->count();
        return view('backend.dashboard', compact('users','roles','pages', 'menus', 'users_count'));
    }
}
