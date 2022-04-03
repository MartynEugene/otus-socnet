<?php

namespace App\Http\Controllers;

use App\Components\Auth\LoginAction;
use App\Components\Auth\RegisterAction;
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

        $register = new RegisterAction();
        $register->setParams($validator->validated());
        if(!$register->run()) {
            return view('auth.signup', ['error' => $register->error()]);
        }
        return view('auth.signup', ['error' => 'OK']);
    }

    public function login(Request $request)
    {
        $login = new LoginAction();
        $result = $login->run($request);
        if (!$result) {
            return view('auth.signin', ['error' => 'Wrong credentials']);
        }

        return redirect()->to('/');
    }

    public function logout(Request $request)
    {
        $login = new LoginAction();
        $login->logout($request);
    }
}
