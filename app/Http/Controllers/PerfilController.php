<?php

namespace App\Http\Controllers;

use App\Models\User;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;

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
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twith,editar-perfil'],
            
        ]);
       
        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($imagen);
            $image->cover(1000, 1000);
    
            $imagePath = public_path('perfiles') . '/' .$nombreImagen;
            $image->save($imagePath);
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? '';
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
