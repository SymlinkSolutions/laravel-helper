<?php

namespace Symlink\LaravelHelper\Http\Controllers\Guest\Index;

use Symlink\LaravelHelper\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller {
    public function showLoginForm() {
        return view('symlink::guest.index.login');
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('home');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

}