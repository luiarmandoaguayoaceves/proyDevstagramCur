<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index () {
        return view('auth.register');
    }

    public function store (Request $request) {
        // dd($requests);

        // Modificar el reques
        $request->request->add(['username' => Str::slug( $request->username)]);

        // validación
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min: 6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        // Autenticar usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password'=>$request->password
        // ]);


        // Otra forma de autenticar
        auth()->attempt($request->only(['email', 'password']));

        // Redireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username)->with('mensaje', 'Bienvenido a DevStagram');
    }
}
