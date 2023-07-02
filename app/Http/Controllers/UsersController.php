<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);

        // Hash::make(...)-> Faz o password_hash de uma senha
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        // Faz com que um usuario fique no estado "logado"
        Auth::login($user);

        return to_route('series.index');
    }

   
}
