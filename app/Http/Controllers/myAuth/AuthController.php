<?php

namespace App\Http\Controllers\myAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function check(Request $request)
    {
        $field = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::firstWhere('email', $field['email']);

        if (!$user && !Hash::check($field['password'], $user->password)) {
            return response(['message' => 'password or email in incarect!']);
        }

        $token = $user->createToken('30nama')->plainTextToken;
        Auth::loginUsingId($user->id, true);

        return response(['token' => $token, 'user' => $user]);
    }

    public function signin(Request $request)
    {
        $field = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::create([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' => $field['password']
        ]);

        $toke = $user->createToken('30nama')->plainTextToken;
        Auth::loginUsingId($user->id, true);

        return response(['user' => $user, 'token' => $toke]);

    }

    public function mylogout()
    {
        auth()->user()->tokens()->delete();
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('login');
    }
}
