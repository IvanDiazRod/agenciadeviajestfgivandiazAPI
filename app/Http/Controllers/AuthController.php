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

        // 2. Creación del usuario
$user = User::create([
    'firstname'     => $request->firstname,
    'surname'       => $request->surname,
    'secondsurname' => $request->secondsurname,
    'email'         => $request->email,
    'dateofbirth'   => $request->dateofbirth,
    'gender'        => $request->gender,
    'password'      => Hash::make($request->password),
]);

        // 3. Generación del token (Sanctum)
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Respuesta para React
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

    // 1. (Opcional) Borramos tokens antiguos para no llenar la base de datos
    $user->tokens()->delete();

    // 2. CREAMOS EL TOKEN PLANO AQUÍ
    $token = $user->createToken('auth_token')->plainTextToken;

    // 3. SE LO ENVIAMOS A REACT
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

    // 1. Borrar la foto anterior si existe para no acumular basura
    if ($user->profile_photo_path) {
        Storage::disk('public')->delete($user->profile_photo_path);
    }

    // 2. Guardar la nueva foto en la carpeta 'profile-photos' dentro de 'public'
    $path = $request->file('photo')->store('profile-photos', 'public');

    // 3. Actualizar la base de datos
    $user->update([
        'profile_photo_path' => $path,
    ]);

return response()->json([
    'message' => 'Photo updated successfully',
    // ESTO ES VITAL: Obligamos a Laravel a incluir el accessor 'profile_photo_url' en el JSON
    'user' => $user->append('profile_photo_url'), 
]);
}
}