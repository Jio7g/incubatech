@extends('layouts.app')

@section('content')
<!-- Usuarios (solo para SuperUsuario y Administrador) -->
@if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4">
            <h1 class="text-2xl font-bold text-white mb-6 text-center">Registro de Usuario</h1>
        </div>
        <div class="p-6">
            <div class="max-w-md mx-auto">
                <!-- Asegúrate de que la etiqueta form incluya todos los elementos de entrada -->
                <form id="userForm" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="nombre" name="nombre" value="{{ old('nombre') }}" autofocus>
                        @error('nombre')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="correo" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
                        <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="correo" name="correo" value="{{ old('correo') }}">
                        @error('correo')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                        <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password" required>
                        @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">Confirmar Contraseña</label>
                        <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="password-confirm" name="password_confirmation" required>
                    </div>
                    <div class="mb-6">
                        <label for="rol" class="block text-gray-700 text-sm font-bold mb-2">Rol</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="rol" name="rol" required>
                            <option value="">Selecciona un rol</option>
                            <option value="Usuario" {{ old('rol') == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                            <option value="Administrador" {{ old('rol') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="SuperUsuario" {{ old('rol') == 'SuperUsuario' ? 'selected' : '' }}>SuperUsuario</option>
                        </select>
                        @error('rol')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('users.index') }}" class="bg-blue-900 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Regresar
                        </a>
                        <button type="submit" class="bg-green-600 hover:bg-green-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <svg class="h-5 w-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Registrar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
