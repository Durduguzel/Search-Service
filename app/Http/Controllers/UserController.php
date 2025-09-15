<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Log;
use Session;
use App\Models\User;
use App\Models\UserActionLog;
use App\Helpers\UserActionLogHelper;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if ( Auth::attempt($credentials) )
        {
            return Redirect()->route('dashboard.index')->withSuccess("Login successful");
        }

        return redirect('login')->withErrors("Login failed");
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
