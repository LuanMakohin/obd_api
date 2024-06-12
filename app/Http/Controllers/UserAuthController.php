<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function register(UserRegisterRequest $request){
        try {
            $registerUserData = $request->validate([
                'name'=>'required|string',
                'email'=>'required|string|email|unique:users',
                'password'=>'required|min:8',
                'plan' => 'required'
            ]);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Nome de usuário ou senha inválidos']);
        }

        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
            'plan' => $registerUserData['plan']
        ]);
        return response()->json([
            'message' => 'Usuário Criado ',
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8'
        ]);
        $user = User::where('email', $loginUserData['email'])->first();
        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 401);
        }
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'plan' => $user->plan
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            "message"=>"Saiu"
        ]);
    }
}
