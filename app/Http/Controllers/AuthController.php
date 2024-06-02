<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['message' => 'Invalid Credentials!'], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json(['user' => $user, 'token' => $user->createToken('API Token of' . $user->name)]);
    }

    /**
     * Store a newly created user
     * 
     */
    public function register(StoreUserRequest $request, AuthService $authService)
    {
        $user = $authService->register($request->validated());
        return response()->json(['user' => $user, 'token' => $user->createToken('API Token of' . $user->name)]);
    }

    public function logout()
    {
        return response()->json('logout');
    }
}
