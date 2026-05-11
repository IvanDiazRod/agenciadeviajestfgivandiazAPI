<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Mail\WelcomeNewsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Por favor, introduce un correo válido.',
            'email.unique' => '¡Ya estás en nuestra lista de viajeros!',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }
        $subscriber = Subscriber::create([
            'email' => $request->email
        ]);
        Mail::to($subscriber->email)->send(new WelcomeNewsletter());
        return response()->json([
            'message' => '¡Suscripción completada con éxito! Revisa tu bandeja de entrada.'
        ], 201);
    }
}