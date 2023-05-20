<?php

namespace App\Usecase\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUsecase
{
    /**
     * @param Request $request
     * @return User|boolean
     */
    public function handle(Request $request): User|bool
    {
        $credential = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if (!Auth::attempt($credential)) {
            return false;
        }

        $request->session()->regenerate();
        return Auth::user();
    }
}
