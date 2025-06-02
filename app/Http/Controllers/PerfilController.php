<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
{
    $request->validate([
        'username' => ['required', 'unique:users,username,' . auth()->id(), 'min:3', 'max:20', 'not_in:twith,editar-perfil'],
        'email' => ['required', 'email', 'max:50', 'unique:users,email,' . auth()->id()],
    ]);

    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($imagen);
        $image->cover(1000, 1000);
        $image->save(public_path('perfiles') . '/' . $nombreImagen);
    }

    // Declarar la variable para evitar el error de "undefined variable"
    $password = auth()->user()->password;

    if ($request->filled('passwordNuevo')) {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->withErrors(['password' => 'La contraseña actual no es correcta.']);
        }

        $request->validate([
            // Valida el campo 'passwordNuevo' solicitando:
            // - que sea obligatorio ('required')
            // - que tenga al menos 6 caracteres ('min:6')
            // - que tenga como máximo 20 caracteres ('max:20')
            'passwordNuevo' => ['required', 'min:6', 'max:20'],
        ]);

        $password = bcrypt($request->passwordNuevo);
    }

    $usuario = User::find(auth()->id());
    $usuario->username = $request->username;
    $usuario->email = $request->email;
    $usuario->password = $password;
    $usuario->imagen = $nombreImagen ?? $usuario->imagen;
    $usuario->save();

    return redirect()->route('posts.index', $usuario->username);
}

}
