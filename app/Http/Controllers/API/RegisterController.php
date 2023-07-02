<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    public function login_page()
    {
        return view('auth/login');
    }

    public function register_page()
    {
        return view('auth/register');
    }

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('30nma')->plainTextToken;
        $success['name'] = $user->name;

        Auth::login($user, true);

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request): JsonResponse
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('30nma')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('a-login');
    }
}
