<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm() {   
        if(Session::has('administrator')) {
            return redirect()->route('dashboard');
        }

        $scripts = ['users.js'];
        return view('login', compact('scripts'));
    }

    public function login(Request $request) 
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if($email == '') {
            return Response()->json([
                'success' => false,
                'message' => 'Debes ingresar tu email para ingresar al sitio'
            ]);
        }

        if($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Response()->json([
                'success' => false,
                'message' => 'El email ingresado es inválido'
            ]);
        }

        if ($email && strlen($email) > 60) {
            return Response()->json([
                'success' => false,
                'message' => 'La contraseña debe contener menos de 60 caracteres'
            ]);
        }

        if($password == '') {
            return Response()->json([
                'success' => false,
                'message' => 'Debes ingresar tu contraseña para ingresar al sitio'
            ]);
        }

        $verifyEmail = User::where('email', $email)->first();

        if(!$verifyEmail) {
            return Response()->json([
                'success' => false,
                'message' => 'No existe usuario registrado con ese email'
            ]);
        }

        if(!Hash::check($password, $verifyEmail->password)) {
            return Response()->json([
                'success' => false,
                'message' => 'La contraseña ingresada es inválida'
            ]);
        }

        Auth::login($verifyEmail);
        
        $userData = [
            'id' => $verifyEmail->id,
            'name' => $verifyEmail->name,
            'surname' => $verifyEmail->surname,
            'email' => $verifyEmail->email
        ];

        Session::put('administrator', $userData);

        return Response()->json([
            'success' => true
        ]);
    }

    public function logout()
    {
    Auth::logout();
    Session::flush();
    return redirect()->route('login');
    }

    public function showSessionInfo() {
        if (Session::has('administrator')) {
            return response()->json(Session::get('administrator'));
        } else {
            return redirect()->route('login');
        }
    }
}
