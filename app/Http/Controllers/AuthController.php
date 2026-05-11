<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname'     => 'required|string|max:255',
            'surname'       => 'required|string|max:255',
            'secondsurname' => 'nullable|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'dateofbirth'   => 'required|date',
            'gender'        => 'required|in:male,female,iprefernotsay',
            'password'      => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

$user = User::create([
    'firstname'     => $request->firstname,
    'surname'       => $request->surname,
    'secondsurname' => $request->secondsurname,
    'email'         => $request->email,
    'dateofbirth'   => $request->dateofbirth,
    'gender'        => $request->gender,
    'password'      => Hash::make($request->password),
]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'      => 'User registered successfully',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
        ], 201);
    }
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    $user = Auth::user();

    $user->tokens()->delete();

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ]);
}
public function updateProfilePhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
    ]);

    $user = $request->user();

    if ($user->profile_photo_path) {
        Storage::disk('public')->delete($user->profile_photo_path);
    }

    $path = $request->file('photo')->store('profile-photos', 'public');

    $user->update([
        'profile_photo_path' => $path,
    ]);

return response()->json([
    'message' => 'Photo updated successfully',
    'user' => $user->append('profile_photo_url'), 
]);
}
}