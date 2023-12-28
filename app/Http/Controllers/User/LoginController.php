<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\MakeLoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.login');
    }

    public function store(MakeLoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();
            return redirect()->intended('/user/dashboard');
        }
        return redirect()->back()->with('message', 'credentials does not matched');
    }
}
