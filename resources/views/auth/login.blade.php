{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            <div class="bg-gray-800 text-white py-4 px-6 rounded-t-lg">
                <h4 class="text-2xl font-bold">INICIAR SESIÓN</h4>
            </div>
            <div class="mt-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="correo" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="correo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="correo" name="correo" required autofocus>
                        @error('correo')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password" required>
                        @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500" id="remember">
                            <span class="ml-2 text-gray-700">Recuérdame</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Login
                        </button>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('password.request') }}" class="text-blue-500 hover:text-blue-600">¿Olvidaste la contraseña?</a>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600">Registrarse</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
