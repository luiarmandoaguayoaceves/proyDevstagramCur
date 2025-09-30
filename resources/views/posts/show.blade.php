@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="p-3 flex items-center gap-4">

                @auth
                <livewire:like-post :post="$post"/>

                   
                @endauth
                
            </div>

            <div>
                <p class="font-bold">
                    {{ $post->user->username }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
                @auth
                    @if ($post->user_id === auth()->user()->id)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar publicacion"
                                class="bg-red-500 hover:bg-red-600 p-2 text-white font-bold uppercase rounded-lg mt-5 cursor-pointer">
                        </form>
                    @endif
                @endauth
            </div>
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 text-white p-2 rounded-lg mb-4 text-sm text-center">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un comentario</label>
                        <textarea name="comentario" id="comentario" placeholder="Agrega un comentario"
                            class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"></textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                        <input type="submit" value="Comentar"
                            class="bg-blue-500 hover:bg-blue-600 transition-colors cursor-pointer font-bold text-white uppercase w-full p-3 mt-5 rounded-lg">
                    </form>
                @endauth

                <div class="bg-white shadow mt-10 max-h-96 overflow-y-scroll">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-b border-gray-200">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                    {{ $comentario->user->username }}
                                </a>
                                <p class="mt-5">
                                    {{ $comentario->comentario }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $comentario->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-3 text-gray-600 text-sm text-center">No hay comentarios aún</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
