<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(User $user){

        return view('dashboard', [
            'user' => $user
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $request->validate( [
            'titulo' => 'required|max:255 ',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);
    }
}
