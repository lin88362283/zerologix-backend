<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * Login The User
     * @param Request $request
     * @return User
     */

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            /** @var \App\Models\User $user **/
            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['email'] =  $user->email;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function logout()
    {
        return $this->sendResponse(['token' => null], 'User logout successfully');
    }

    public function checkMe()
    {
        $user = Auth::user();
        return $this->sendResponse(['email' => $user->email], 'Current User Info');
    }
}
