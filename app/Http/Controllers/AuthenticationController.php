<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('LaravelSanctumAuth')->plainTextToken;
    
            return response()->json([
                'token' => $token
            ]);
        } else {
            return response()->json(['message' => 'Login gagal'], 401);
        }
    }
    

    public function logout(request $request){
        $request->user()->currentAccessToken()->delete();
    }
    public function me(request $request){
        return response()->json(Auth::user());
    }


}
