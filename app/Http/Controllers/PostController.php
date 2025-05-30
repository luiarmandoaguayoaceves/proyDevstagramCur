<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(User $user){

        $post = Post::where('user_id', $user->id)->paginate(20);
        return view('dashboard', [
            'user' => $user,
            'posts' => $post
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

        // Post::create([
        //     'titulo'  => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        $request->user()->posts()->create([
            'titulo'  => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect(route('posts.index', auth()->user()->username));
    }

    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
