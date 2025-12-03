<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    // Mostrar formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'email.unique' => 'El correo electrónico ya esta siendo utilizado en otra cuenta',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autenticar al usuario después del registro
        auth()->login($user);

        return redirect()->route('dashboard')->with('success', '¡Registro exitoso!');
    }
}