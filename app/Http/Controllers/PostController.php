<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        $this->middleware('auth')->except(['show', 'index']);
    }

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
            'user' => auth()->user(),
            'post' => $post
        ]);
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        //eliminar la imagen
        $imagen_path = public_path('uploads') . '/' . $post->imagen;
        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }
        $post->delete();
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
