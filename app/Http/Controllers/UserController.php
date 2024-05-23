<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index() {
        $users = User::select('id', 'name', 'surname', 'email', 'created_at')->orderBy('id', 'desc')->paginate(10);
        $usersCount = User::count();
        $scripts = ['users.js'];
        return view('admin.users.index', compact('users', 'usersCount', 'scripts'));
    }

    public function create() {
        $scripts = ['users.js'];
        return view('register', compact('scripts'));
    }

    public function store(Request $request) {

        $messages = [
            'name.required' => 'Debes ingresar tu nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.max' => 'El nombre debe tener un máximo de 20 caracteres',
            'name.regex' => 'El nombre sólo puede contener letras y espacios',
            'surname.required' => 'Debes ingresar tu apellido',
            'surname.min' => 'El apellido debe tener al menos 3 caracteres',
            'surname.max' => 'El apellido debe tener un máximo de 20 caracteres',
            'surname.regex' => 'El apellido sólo puede contener letras, espacios y comillas simples',
            'email.required' => 'Debes ingresar tu email',
            'email.max' => 'El email debe tener un máximo de 60 caracteres',
            'email.email' => 'El email es inválido',
            'email.unique' => 'Ya existe un usuario registrado con ese email',
            'password.required' => 'Debes ingresar tu password',
            'password.min' => 'El password debe contener al menos 5 caracteres',
            'repeat-password.required' => 'Complete el campo "repetir contraseña"',
            'repeat-password.same' => 'Las contraseñas no coinciden',
        ];

        // Expresiones regulares para nombre y apellido
        $nameRegex = '/^[a-zA-Z\s´]+$/';
        $surnameRegex = '/^[a-zA-Z\s\'´]+$/';
        
        $validations = $request->validate([
           'name' => ['required', 'min:2', 'max:25', 'regex:' . $nameRegex],
           'surname' => ['required', 'min:3', 'max:20', 'regex:' . $surnameRegex],
           'email' => 'required|max:60|email|unique:users',
           'password' => 'required|min:5',
           'repeat-password' => 'required|same:password',

        ], $messages);

        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $password = $request->input('password');
        $repeatPassword = $request->input('repeat-password');

        $userModel = new User();
        $userModel->name = $name;
        $userModel->surname = $surname;
        $userModel->email = $email;
        $userModel->password = Hash::make($password);
        $userModel->password = Hash::make($repeatPassword);
        $userModel->save();

        return Response()->json([
            'success' => true, 
            'message' => 'Usuario registrado con éxito'
        ]);
    }

    public function edit($id) {
        $userData = User::select('id', 'name', 'surname', 'email')->where('id', $id)->first();
        if (!$userData) {
            return redirect()->route('admin.users.index');
        }
        $scripts = ['users.js'];
        return view('admin.users.edit', compact('userData', 'scripts')); 
    }

    public function update($id, Request $request) {
        $messages = [
            'name.required' => 'Debes ingresar el nombre del usuario',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.max' => 'El nombre debe tener un máximo de 20 caracteres',
            'name.regex' => 'El nombre sólo puede contener letras y espacios',
            'surname.required' => 'Debes ingresar el apellido del usuario',
            'surname.min' => 'El apellido debe tener al menos 3 caracteres',
            'surname.max' => 'El apellido debe tener un máximo de 20 caracteres',
            'surname.regex' => 'El apellido sólo puede contener letras, espacios y comillas simples',
            'email.required' => 'Debes ingresar el email',
            'email.max' => 'El email debe tener un máximo de 60 caracteres',
            'email.email' => 'El email es inválido',
            'email.unique' => 'Ya existe un usuario registrado con ese email',
            'password.required' => 'Debes ingresar tu password',
            'password.min' => 'El password debe contener al menos 5 caracteres',
            'repeat-password.required' => 'Complete el campo "repetir contraseña"',
            'repeat-password.same' => 'Las contraseñas no coinciden',
        ];
        
        // Expresiones regulares para nombre y apellido
        $nameRegex = '/^[a-zA-Z\s´]+$/';
        $surnameRegex = '/^[a-zA-Z\s\'´]+$/';

        $validations = $request->validate([
           'name' => ['required', 'min:2', 'max:25', 'regex:' . $nameRegex],
           'surname' => ['required', 'min:3', 'max:20', 'regex:' . $surnameRegex],
           'email' => 'required|max:60|email|unique:users,email,'.$id.',id',
           'password' => 'nullable|min:5',
           'repeat-password' => 'nullable|same:password',

        ], $messages);

        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $password = $request->input('password');

        if ($password) {
            User::where('id', $id)->update([
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
        } else {
            User::where('id', $id)->update([
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
            ]);
        }

        return Response()->json([
            'success' => true, 
            'message' => 'Usuario editado con éxito'
        ]);
    }

    public function delete($id) {
        $userData = User::where('id', $id)->first();
        
        if(!$userData) {
            return Response()->json([
                'success' => false,
                'message' => 'No existe usuario registrado con dicho ID'
            ]);
        }

        if ($id == Session('administrator')['id']) {
            return Response()->json([
                'succes' => false,
                'message' => 'No puedes eliminarte a tí mismo del sistema'
            ]);
        }

        User::where('id', $id)->delete();
        return Response()->json([
            'success' => true,
            'message' => 'Usuario eliminado con éxito'
        ]);
    }

    public function search(Request $request) {
        $search = $request->search;
        $users = User::where('name', 'like', "%$search%")
                    ->orWhere('surname', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->paginate(10);
        $usersCount = $users->total();
        $scripts = ['users.js'];
        return view('admin.users.index', compact('users', 'usersCount', 'scripts', 'search'));

    }
}
