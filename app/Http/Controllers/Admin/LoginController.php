<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginPage()
    {
        return view('admin_auth.admin_login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);


        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            if (!$user->where('role_id', Role::where('name', 'admin')->first()->id)->first()) {
                return redirect()->back()->withInput()->withErrors(['email' => 'you are not a admin']);
            }
            if (!Auth::guard('admin')->attempt($request->only('email', 'password'),$request->input('remember'))) {
                return redirect()->back()->withInput()->withErrors(['email' => 'undefined credentials']);
            }
            return redirect()->route('admin_dashboard');
        }
        return redirect()->back()->withInput()->withErrors(['email' => 'undefined email']);
    }

    public function logout() {
        if(!Auth::guard('admin')->check()) return redirect('admin/login');
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    }
    
}
