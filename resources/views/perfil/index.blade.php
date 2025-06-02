@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
<div class="md:flex md:justify-center ">
    <div class="md:w1/2 bg-white shadow p-6">
        <form class="mt-10 md:mt-0" action="{{ route('perfil.store', auth()->user()) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                <input 
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Nombre de Usuario"
                    class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                    value="{{ auth()->user()->username }}"
                />
                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                <input 
                    id="email"
                    name="email"
                    type="email"
                    placeholder="Correo Electrónico"
                    class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                    value="{{ auth()->user()->email }}"
                />
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password Nuevo</label>
                <input 
                    id="passwordNuevo"
                    name="passwordNuevo"
                    type="password"
                    placeholder="Nueva Contraseña"
                    class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    value=""
                />
                @error('passwordNuevo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password Actual</label>
                <input 
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Contraseña Actual"
                    class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    value=""
                />
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
           
            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                <input 
                    id="imagen"
                    name="imagen"
                    type="file"
                    accept=".jpg, .jpeg, .png"
                    class="border p-3 w-full rounded-lg @error('imagen') border-red-500 @enderror"
                />
                @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <input 
                type="submit" 
                value="Actualizar Perfil"
                class="bg-blue-600 hover:bg-blue-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            />
        </form>
    </div>


</div>
@endsection
