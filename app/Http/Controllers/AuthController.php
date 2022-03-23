<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $params = $request->all();
        $validator = Validator::make($params, [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'terms' => 'required',
        ]);

        if ($validator->fails()) {
            return view('auth.signup', ['error' => $validator->errors()->first()]);
        }

        return view('auth.signup', ['error' => 'OK']);
    }

    public function login(Request $request)
    {
        return view('auth.signin', ['error' => 'loginus']);
    }
}
