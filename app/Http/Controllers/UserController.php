<?php

namespace App\Http\Controllers;

use App\Components\Auth\LoginComponent;
use App\Components\Userbase\InfoComponent;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function info(Request $request)
    {
        $login = new LoginComponent();
        $email = $login->getEmail($request);
        $info = new InfoComponent();
        $userInfo = $info->getUserData($email);

        return view('users.info', [
            'email' => $email,
            'info' => $userInfo
        ]);
    }

    public function editInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|alpha',
            'lastname' => 'required|string|alpha',
            'gender' => 'required|string',
            'city' => 'string',
            'hobbies' => 'string',
        ]);

        $login = new LoginComponent();
        $email = $login->getEmail($request);

        if ($validator->fails()) {
            return view('users.info', [
                'email' => $email,
                'error' => $validator->errors()->first()
            ]);
        }

        $info = new InfoComponent();
        $result = $info->editInfo($email, $validator->validated());
        if($result) {
            return redirect()->to('/');
        }

        return view('users.info', ['error' => 'Internal error']);
    }
}
