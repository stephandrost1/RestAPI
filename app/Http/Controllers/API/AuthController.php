<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(AuthRegisterRequest $request)
    {
        $user = User::create([
            'name' =>  $request->name,
            'email' =>  $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }


    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(AuthLoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            die('ingelogd');
        }

        die('Foute credentials');

        // $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            // 'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
