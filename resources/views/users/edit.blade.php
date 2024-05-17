@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            <div class="bg-gradient-to-r from-gray-800 to-blue-900 text-white py-4 px-6 rounded-t-lg">
                <h4 class="text-2xl font-bold">Editar Usuario</h4>
            </div>
            <div class="mt-6">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="nombre" name="nombre" value="{{ $user->nombre }}" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label for="correo" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
                        <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="correo" name="correo" value="{{ $user->correo }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="rol" class="block text-gray-700 text-sm font-bold mb-2">Rol</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="rol" name="rol" required>
                            <option value="" disabled>Selecciona un rol</option>
                            <option value="Usuario" {{ $user->rol == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                            <option value="Administrador" {{ $user->rol == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="SuperUsuario" {{ $user->rol == 'SuperUsuario' ? 'selected' : '' }}>SuperUsuario</option>
                        </select>
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Actualizar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
