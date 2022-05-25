<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;
    public function index()
    {
        
    }



    public function register(RegisterUserRequest $request)
    {
        $payload = $request->all();
        $payload['password'] = Hash::make($payload['password']);

        $user = User::create($payload);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        $payload = $request->all();


        if (!Auth::attempt($payload)) {
            return $this->error('Credentials not match', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ], message: 'O USUARIO FOI CRIADO');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
