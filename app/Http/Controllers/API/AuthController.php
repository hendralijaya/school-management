<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Register a new user.
     *
     * @param  RegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->api($user, 'User created successfully', null, 201);
    }

    /**
     * Login user and generate access token.
     *
     * @param  LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $token = Auth::attempt($validatedData);
        if (!$token) {
            return response()->api(null, 'Invalid credentials', 'Unauthorized', 401);
        }

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
}
