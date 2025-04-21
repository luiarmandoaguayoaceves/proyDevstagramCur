@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post{{ $post->titulo }}">
            <div class="p-3">
                <p>
                    0 Likes
                </p>
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
            </div>
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth

                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                    <form action="">
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
            </div>
        </div>
    </div>
@endsection
