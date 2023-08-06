<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('estado', '!=', 'pendente')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }
}
