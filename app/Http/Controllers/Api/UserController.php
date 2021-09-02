<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required', 'email'],
                'password' => ['required', 'min:1'],
            ],
            [
                'email.required'    => 'Mohon masukkan email',
                'email.email'       => 'Email tidak sesuai',
                'password.required' => 'Mohon masukkan password',
                'password.min'      => 'Masukkan password minimal 8 karakter'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }


        if (!$token = auth()->guard('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Akun tidak terdaftar.'], 401);
        }

        return $this->generateToken($token);
    }

    protected function generateToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => auth()->guard('api')->user(),
            'error' => null
        ]);
    }

    public function logout()
    {
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Succesfully signed out', 'error' => null]);
    }
}
