<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index() {
        $users = User::select('id', 'name', 'surname', 'email', 'created_at')->orderBy('id', 'desc')->paginate(1);
        $usersCount = User::count();
        $scripts = ['users.js'];
        return view('admin.users.index', compact('users', 'usersCount', 'scripts'));
    }
}
