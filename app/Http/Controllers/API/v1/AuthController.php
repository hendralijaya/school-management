<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\v1\Auth\LoginRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\API\v1\Auth\RegisterRequest;
// use App\OpenApi\RequestBodies\API\v1\Auth\LoginRequestBody;
// use App\OpenApi\RequestBodies\API\v1\Auth\RegisterRequestBody;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class AuthController extends Controller
{
    // middleware auth:api except login and register
    // how to add to openapi documentation

    // #[OpenApi\Operation(tags: ['auth'], method: 'post')]
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

    // #[OpenApi\Operation(null, ['auth'], JWTSecurityScheme::class, 'POST', null)]
    // #[OpenApi\RequestBody(factory: LoginRequestBody::class)]
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
    #[OpenApi\Operation(null, ['auth'], JWTSecurityScheme::class, 'POST', null)]
    public function logout()
    {
        // Revoke the token that was used to authenticate the current request...
        Auth::logout();
        return response()->api(null, 'Logged out successfully', null, 200);
    }

    /**
     * Refresh user token.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(null, ['auth'], JWTSecurityScheme::class, 'POST', null)]
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
    #[OpenApi\Operation(null, ['auth'], JWTSecurityScheme::class, 'GET', null)]
    public function test()
    {
        return response()->api(null, 'Test', null, 200);
    }
}
