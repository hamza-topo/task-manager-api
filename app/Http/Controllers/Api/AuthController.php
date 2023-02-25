<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(protected UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        $token = $this->userService->login($request);
        return $this->loginResponse($token);
    }

    public function register(RegisterRequest $request)
    {
        $formattedUser = $this->userService->formatUser($request);
        $user = $this->userService->create($formattedUser);
        $token = Auth::login($user);
        return $this->registerResponse($token, $user);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }



    private function loginResponse(string $token)
    {
        if (!$token) {
            return response()->json([
                'status' => 'error', 'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'success', 'user' => $user,
            'authorisation' => [
                'token' => $token, 'type' => 'bearer',
            ]
        ]);
    }

    private function registerResponse($token, User $user)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
}
