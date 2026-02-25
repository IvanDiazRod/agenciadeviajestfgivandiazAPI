<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'secondsurname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'dateofbirth' => 'required|date',
            'gender' => 'required|in:male,female,iprefernotsay',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'firstname' => $validated['firstname'],
            'surname' => $validated['surname'],
            'secondsurname' => $validated['secondsurname'] ?? null,
            'email' => $validated['email'],
            'dateofbirth' => $validated['dateofbirth'],
            'gender' => $validated['gender'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'message' => 'User registered successfully'
        ], 201);
    }
}