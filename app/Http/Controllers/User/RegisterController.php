<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index()
    {
        return view('user.register');
    }

    public function store(StoreUserRequest $request)
    {
        $user_details = $request->validated();
        if ($request->hasFile('image')) {
            $file_path = Storage::put('upload/', $request->file('image'));
            $user_details['image'] = $file_path;
        }
        $user = User::create($user_details);
        //Creates a Session for the user and log the user in the system without login
        $logedUser = Auth::login($user);


        return redirect()->route('dashboard');
    }
}
