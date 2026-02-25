<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = bin2hex(random_bytes(40));

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'secondsurname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'dateofbirth' => 'required|date',
            'gender' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'surname' => $request->surname,
            'secondsurname' => $request->secondsurname,
            'email' => $request->email,
            'dateofbirth' => $request->dateofbirth,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        $token = bin2hex(random_bytes(40));

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}