<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['response'=>'Email and password required'], 400);
            }

            $user = User::where('email', $request->email)->first();


            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['response'=>'The provided credentials are incorrect.'], 400);
            }

            return $user->createToken('token')->plainTextToken;
        }

    

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
    }

    public function users()
    {
        return User::all();
    }
}