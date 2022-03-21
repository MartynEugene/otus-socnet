<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup()
    {
        return view('auth.signup');
    }

    public function signin()
    {
        return view('auth.signin');
    }

    public function register(Request $request)
    {
        return view('auth.signup', ['error' => 'Unable to register']);
    }

    public function login(Request $request)
    {
        return view('auth.signin', ['error' => 'Unable to login']);
    }
}
