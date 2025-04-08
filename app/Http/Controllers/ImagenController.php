<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ImagenController extends Controller
{
    public function  store(Request $request)
    {
        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($imagen);
        $image->cover(1000, 1000);

        $imagePath = public_path('uploads') . '/' .$nombreImagen;
        $image->save($imagePath);
        return response()->json(['imagen' => $nombreImagen]);
    }
}
