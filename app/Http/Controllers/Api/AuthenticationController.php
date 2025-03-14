<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends BaseApiController
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $user->createToken('passportToken')->accessToken;

        return $this->returnJSON(new UserResource($user),true ,200 , 'User registered successfully');

    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return $this->returnJSON(new UserResource(Auth::user()),true ,200 , 'Logged-in successfully');
        }

        return $this->returnWrong('Unauthorised');
    }

    public function logout()
    {

        $user = Auth::guard('api')->user()->token();
        $user->revoke();

        return $this->returnSuccess('Logged out successfully');
    }
}
