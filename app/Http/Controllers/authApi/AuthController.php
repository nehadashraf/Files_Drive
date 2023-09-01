<?php

namespace App\Http\Controllers\authApi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $token = $user->createToken('myToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
            'messsage' => 'Welcome new user'
        ];
        return response($response, 200);
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', '=', $data['email'])->first();
        $password = Hash::check($data['password'], $user->password);
        if (!$user || !$password) {
            return response('enter right password or email');
        } else {
            $token = $user->createToken('myToken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
                'message' => 'Welcome user'
            ];
            return response($response, 200);
        }
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
    }
}
