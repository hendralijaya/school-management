<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 1,
        ]);

        return response()->api($user, 'User created successfully', null, 201);
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::where('email', $validatedData['email'])->first();
        $token = JWTAuth::claims(['email' => $user->email, 'role_id' => $user->role_id])->attempt($validatedData);
        if (!$token) {
            return response()->api(null, 'Invalid credentials', 'Unauthorized', 401);
        }

        // $token = JWTAuth::fromUser($user, ['email' => $user->email, 'role_id' => $user->role_id]);
        // // verify token validity
        // if (!JWTAuth::check($token)) {
        //     return response()->api(null, 'Invalid token', 'Unauthorized', 401);
        // }

        $user = $request->user();

        return response()->api([
            'user' => $user, 'authorization' => [
                "token" => $token,
                "type" => "bearer",
            ]
        ], "User logged in successfully", null, 200);
    }

    /**
     * Logout user and revoke access token.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request...
        Auth::logout();
        return response()->api(null, 'Logged out successfully', null, 200);
    }

    public function refresh()
    {
        return response()->api([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ], "Refresh token", null, 200);
    }

    public function test()
    {
        return JWTAuth::parseToken()->authenticate();
    }
}
